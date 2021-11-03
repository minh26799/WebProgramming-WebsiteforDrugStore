function Validator(formSelector) {


    function getParent(element, selector) {
        while (element.parentElement) {
            if (element.parentElement.matches(selector))
                return element.parentElement;
        }
        element = element.parentElement;
    }

    var _this = this;

    var formRules = {};
    var validatorRules = {
        required: function(value) {
            return value ? undefined : "Please Input";
        },
        min: function(min) {
            return function(value) {
                return value.length >= min ? undefined : `Please input at least ${min} characters`;
            }
        }
    }
    var formElement = document.querySelector(formSelector);


    //Check the formElement
    if (formElement) {
        var inputs = formElement.querySelectorAll('[name][rules]');
        for (var input of inputs) {

            var rules = input.getAttribute('rules').split('|');
            // Get min characters
            for (var rule of rules) {
                var isRuleHasValue = rule.includes(':'); // if rules is check min
                var ruleInfo;
                if (isRuleHasValue) {
                    ruleInfo = rule.split(':');
                    rule = ruleInfo[0];
                }
                var ruleFunction = validatorRules[rule];
                if (isRuleHasValue) {
                    ruleFunction = ruleFunction('')
                }
                //
                if (Array.isArray(formRules[input.name])) {
                    formRules[input.name].push(ruleFunction);
                } else {
                    formRules[input.name] = [ruleFunction];
                }
            }

            // Validate events
            input.onblur = handleValidate;
            input.oninput = handleClearError;

        }

        function handleValidate(event) {
            var rules = formRules[event.target.name];
            var errorMessage;

            for (var rule of rules) {
                errorMessage = rule(event.target.value);
                if (errorMessage)
                    break;
            }

            if (errorMessage) {
                var formGroup = getParent(event.target, '.form-group');
                if (formGroup) {
                    formGroup.classList.add('invalid');
                    var formMessage = formGroup.querySelector('.form-message');
                    if (formMessage) {
                        formMessage.innerText = errorMessage;
                    }
                }
            }
            return !errorMessage;
        }

        function handleClearError(event) {
            var formGroup = getParent(event.target, '.form-group');
            if (formGroup.classList.contains('invalid')) {
                formGroup.classList.remove('invalid');
                var formMessage = formGroup.querySelector('.form-message');
                if (formMessage) {
                    formMessage.innerText = "";
                }

            }
        }
    }
    this.on
        // submitForm handle
    formElement.onsubmit = function(event) {
        event.preventDefault();
        var inputs = formElement.querySelectorAll('[name][rules]');
        var isValid = true;

        for (var input of inputs) {
            if (!handleValidate({ target: input })) {
                isValid = false;
            }

        }
        if (isValid) {
            if (typeof _this.onSubmit === 'function') {
                var enableInputs = formElement.querySelectorAll('[name]');
                var formValues = Array.from(enableInputs).reduce(function(values, input) {
                    switch (input.type) {
                        case 'radio':
                            values[input.name] = formElement.querySelector('input[name="' + input.name + '"]:checked').value;
                            break;
                        case 'checkbox':
                            if (!input.matches(':checked')) {
                                values[input.name] = '';
                                return values;
                            }
                            if (!Array.isArray(values[input.name])) {
                                values[input.name] = [];
                            }
                            values[input.name].push(input.value);
                            break;
                        case 'file':
                            values[input.name] = input.files;
                            break;
                        default:
                            values[input.name] = input.value;
                    }
                    return values;
                }, {});
                _this.onSubmit(formValues);
            } else {
                formElement.submit();
            }
        }
    }
}