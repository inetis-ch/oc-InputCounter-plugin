# Input Counter
Adds configurable characters counter for text fields.

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
