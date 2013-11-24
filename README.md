# ZurbInkBundle
Creating email templates is hard.
This Symfony Bundle provides some help:

* [Zurb Ink](https://github.com/zurb/ink) Integration for awesome and responsive Emails. Checkout the their [documentation](http://zurb.com/ink/docs.php).
* Use normal CSS-Files for styling, add them via `{{ zurb_ink_styles.add("@YourBundle/Resources/public/css/styles.css") }}`.
* Automatic inline styles via the `{% ìnlinestyle %}` tag (powered by [Tijs Verkoyen's CssToInlineStyles](https://github.com/tijsverkoyen/CssToInlineStyles)).
* Imports your CSS rules also in the html head via `{{ includeStyles(zurb_ink_styles) }}`


## Installation
You can install this bundle using composer

    composer require hampe/zurb-ink-bundle
or add the package to your `composer.json` file directly.

After you have installed the package, you just need to add the bundle to your AppKernel.php file:

    // in AppKernel::registerBundles()
    $bundles = array(
        // ...
        new Hampe\Bundle\ZurbInkBundle\HampeZurbInkBundle(),
        // ...
    );

## Usage

### Option A: Extend the base.html.twig
If you want to use the zurb ink framework, extend the `HampeZurbInkBundle::base.html.twig`.

    {% extends 'HampeZurbInkBundle::base.html.twig' %}
    {% block preHtml %}
        {# add your css files here, please use a bundle relative path #}
        {{ zurb_ink_styles.add("@YourBundle/Resources/public/css/style1.css") }}
        {{ zurb_ink_styles.add("@YourBundle/Resources/public/css/style2.css") }}
        ...
    {% endblock %}
    {% block body %}
        {# html #}
    {% endblock %}

### Option B: Write your own template from scratch

    {# add your styles before the inlinestyle tag #}
    {{ zurb_ink_styles.add("@YourBUndle/Resources/public/css/style.css") }}
    {% inlinestyle %}
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <meta name="viewport" content="width=device-width"/>
            <style type="text/css">
                {% autoescape false %}
                    {{ includeStyles(zurb_ink_styles) }}
                {% endautoescape %}
            </style>
        </head>
        <body>
        {% block body %}

        {% endblock %}
        </body>
    </html>
    {% endinlinestyle %}
## License
See the [LICENSE](LICENSE) file for license info (it's the MIT license).