# ReCaptcha Field ([create acount](http://www.google.com/recaptcha))

## Minimal configuration:

``` yml
# app/config/config.yml
sh_form:
    recaptcha:
        public_key:  `your public key is required`
        private_key: `your private key is required`
```

## Hardcoding the captcha value (for testing)

You can define a static code for your test environment:

``` yml
# app/config/config_test.yml
sh_form:
    recaptcha:
        validation:
            code: 1234
```

## Default Usage:

``` php
<?php
// ...
public function buildForm(FormBuilder $builder, array $options)
{
    $builder
        // ...
        ->add('captcha', 'genemu_recaptcha');
}
```

## Extra:

[Configuration](Resources/doc/recaptcha/default.md)
