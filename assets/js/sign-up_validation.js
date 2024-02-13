const validation = new JustValidate("#signup");
validation
    .addField("#fname", [
        {
            rule: "required"
        }
    ])
    .addField("#lname", [
        {
            rule: "required"
        }
    ])
    .addField("#phone", [
        {
            rule: "required"
        },
        {
            rule: 'customRegexp',
            value: /^\d{3}-\d{3}-\d{4}$/,
            errorMessage: 'Must be in xxx-xxx-xxxx format',
        },
    ])
    // .addField("#license", [
    //     {
    //         rule: "required"
    //     }
    // ])
    .addField("#email", [
        {
            rule: "required"
        },
        {
            rule: "email"
        },
        {
            validator: (value) => () => {
                return fetch("validate-email.php?email=" + 
                encodeURIComponent(value))
                    .then(function(response) {
                        return response.json();
                    })
                    .then(function(json) {
                        return json.available;
                    });
            },
            errorMessage: "Email already taken"
        }
    ])
    .addField("#password", [
        {
            rule: "required"
        },
        {
            rule: "password"
        }
    ])
    .addField("#confirm_password", [
        {
            validator: (value, fields) => {
                return value === fields["#password"].elem.value;
            },
            errorMessage: "Passwords must match"
        }
    ])
    .addField("#tccheckbox", [
        {
            rule: "required"
        }
    ])
    .onSuccess((event) => {
        document.getElementById("signup").submit();
    });