# Easy Navigation

Simple navigation styling and extra category attributes for Magento.

## Installation

### Composer

```
php composer.phar require bennoislost/easy-navigation
``` 

Then refresh Magento caches.

## Usage

### Select a `catalog/category` attribute for use

Add the following snippit to your modules `config.xml` inside the `default` node. Replace `my_new_catalog_attr` with the attribute code you wish to be displayed in your navigation.

```
<frontend>
    <category>
        <collection>
            <attributes>
                <my_new_catalog_attr/>
            </attributes>
        </collection>
    </category>
</frontend>
```

### Display a selected attribute

Copy the following templates to your design package / theme.

* `app/design/frontend/base/default/template/bennoislost/easy-navigation/single-level.phtml`
* `app/design/frontend/base/default/template/bennoislost/easy-navigation/level-with-children.phtml`

You can now use the following snippet to return the `catalog/category` attribute value in your template.

```
$this->getMenu()->getCategoryData()->getData('my_new_catalog_attr');
```
Replace `my_new_catalog_attr` with your attribute code.

With blocks in Magento these can be extended and replaced :)

## Support

If you have any issues with this extension, open an issue on GitHub (see URL above)

##  Contribution

Any contributions are highly appreciated. The best way to contribute code is to open a
[pull request on GitHub](https://help.github.com/articles/using-pull-requests).

## Developer

Ben McManus - [@bennoislost](https://twitter.com/bennoislost)

## Licence

[MIT](http://opensource.org/licenses/MIT)

## Copyright

(c) 2015 Ben McManus

