<?php

namespace hedao\lib\taxonomy;

use \CSF;
use hedao\lib\constant\MetaBoxOptions;
use hedao\core\TSingleton;
use hedao\lib\constant\TaxonomyOptions;

use function hedao\lib\getHeDaoMetaBoxOption;


class TaxonomyView{

  use TSingleton;

  private $_taxonomyTypeArr;

  /**
   * @param array $params [taxonomyTypeArr=(post_tag|category)[]]
   */
  protected function __construct($params)
  {
    $this->_taxonomyTypeArr= $params['taxonomyTypeArr'];
    $this->init();
  }



  public function init(){

    CSF::createTaxonomyOptions(TaxonomyOptions::HEDAO_VIEW_PREFIX, array(
      // 'title'     => '<span class="badge badge-radius badge-primary"><i class="fa fa-codiepie"></i> 浏览量设置 </span> ',
      'taxonomy'  => $this->_taxonomyTypeArr,
      'data_type' => 'unserialize', // The type of the database save options. `serialize` or `unserialize`
    ));

    CSF::createSection(TaxonomyOptions::HEDAO_VIEW_PREFIX, array(
      'fields' => [
          // 标题
          // 浏览量
          array(
            'id'          => TaxonomyOptions::HEDAO_VIEW_COUNT,
            'type'        => 'number',
            'title'       => '浏览量',
            'default'     => '0',
          ),
      ]
    ));

  }
}






