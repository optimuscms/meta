# Meta

Provides a standardised approach to attaching website meta data to Laravel Models. Typically this is used for entities 
such as Pages, Blog Posts, Events, etc, which will need fields like 'Meta Title', 'Meta Description', and 'OG Image' 
when they are presented on the web.

## Installation

You can install the package via composer:

```bash
composer require optimuscms/media
```

Once installed, you should add the tables used by this package to your database:

```bash
php artisan migrate
```

## Key concepts

There are a few key concepts that should be understood before continuing:

* A new model called Meta will be attached to whichever Models you define as requiring meta data.

* It is a 'has one' relationship where the Model can have zero or one Meta Model attached to it.

* The Meta Model depends on the [optimuscms/media](https://github.com/optimuscms/media) package in order to attach images to it.

## Usage

1. Add the `HasMeta` trait to whatever Model you want to collect meta data for:

    ```php
    class MyModel extends Model
    {
        use Optix\Meta\HasMeta;
    ```

1. Add a boot method to your Model (if it doesn't already exist) with the following content:

    ```php
    protected static function boot()
    {
        parent::boot();
    
        static::saved(function ($model) {
            /** @var HasMeta $model */
            $model->saveMeta(request('meta'));
        });
    }
    ```

1. When creating or updating your model (eg. from a CMS action), make sure your form submits its request in the following format:

    ```javascript
    {
        ...MODEL_FIELDS,
        meta: {
            title,
            description, 
            og_title, 
            og_description, 
            custom_tags // free text field for adding custom HTML
        }
    }
    ``` 
   
   This package will automatically pick up the contents of the meta field and process it as required.


## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
