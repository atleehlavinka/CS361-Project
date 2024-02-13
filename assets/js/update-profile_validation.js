const validation = new JustValidate("#update-info");
validation
    .addField("#fname", [
        {
            rule: "required"
        },
    ])
    .addField("#lname", [
        {
            rule: "required"
        },
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
    //     },
    // ])
    .addField("#email", [
        {
            rule: "required"
        },
        {
            rule: "email"
        },
    ])
    .addField("#confirm_email", [
        {
            validator: (value, fields) => {
                return value === fields["#email"].elem.value;
            },
            errorMessage: "Emails must match"
        }
    ])
    .onSuccess((event) => {
        document.getElementById("update-info").submit();
    });

const validation2 = new JustValidate("#change-password");
validation2
    .addField("#current_password", [
        {
            rule: "required"
        },
        {
            rule: "password"
        },
    ])
    .addField("#new_password", [
        {
            rule: "required"
        },
        {
            rule: "password"
        }
    ])
    .addField("#confirm_new_password", [
        {
            validator: (value, fields) => {
                return value === fields["#new_password"].elem.value;
            },
            errorMessage: "Passwords must match"
        }
    ])
    .onSuccess((event) => {
        document.getElementById("change-password").submit();
    });