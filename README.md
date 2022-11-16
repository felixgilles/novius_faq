# ‘FAQ’ application

Allow you to easily create a FAQ for your website.

## Requirements

* The FAQ app runs on Novius OS Dubrovka.
* ‘local/applications’ directory must be writeable.

## Installation

* [How to install a Novius OS application](http://community.novius-os.org/how-to-install-a-nos-app.html)

## Documentation & support

You can leave the "Introduction" field empty, the corresponding html will not be rendered.

* key "use_css" set to true by default : include a small css file to render your FAQ correctly
* `question_additional_fields` : allows you to define custom CRUD fields for the Model_Question like so:
  ```php
  <?php
  
  return array(
      'use_css' => true,
      'question_additional_fields' => array(
          'ques__page_id' => array(
              'label' => 'Lien',
              'renderer' => \Nos\Renderer_Item_Picker::class,
              'renderer_options' => array(
                  'model' => \Nos\Page\Model_Page::class,
                  'appdesk' => 'admin/noviusos_page/appdesk',
              ),
          ),
          'ques__gender' => array(
              'label' => 'Genre',
              'form' => array(
                  'type' => 'select',
                  'options' => array(
                      'm' => 'Masculin',
                      'f' => 'Féminin',
                  ),
              ),
          ),
      ),
  );
  ```
  You still will have to create yourself the corresponding fields in the database.
  
  



## License

Licensed under [GNU Affero General Public License v3](http://www.gnu.org/licenses/agpl-3.0.html) or (at your option) any later version.
