# Input Counter
Adds configurable characters counter for text fields.
![demo](https://user-images.githubusercontent.com/16371551/37961518-c9f25c90-31b8-11e8-803b-6b8ec1527d83.gif)

## Available properties
+ `data-counter` (required)
+ `data-min-length`
+ `data-max-length`
+ `data-optimal-min-length`
+ `data-optimal-max-length`

## Example usage

### From yaml
```yaml
fields:
    ...
    my_field:
        label: My Field
        type: text
        attributes:
            data-counter: true
            data-max-lenght: 50
    ...
```

### From a plugin
```php
public function boot()
{
    Event::listen('backend.form.extendFieldsBefore', function (Backend\Widgets\Form $form) {
        $form->tabs['fields']['viewBag[meta_title]'] += [
            'attributes' => [
                'data-counter',
                'data-optimal-min-length' => 50,
                'data-optimal-max-length' => 60,
            ]
        ];
    }
}
```


## Author
inetis is a webdesign agency in Vufflens-la-Ville, Switzerland. We love coding and creating powerful apps and sites  [see our website](https://inetis.ch).
