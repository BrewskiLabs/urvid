<?php

/**
 * search actions.
 *
 * @package    wines
 * @subpackage search
 * @author     alex
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class searchActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    /**
     * hardcode start
     */
      $this->winery = WinePropertyValuePeer::getWinesValueId(1);
      $this->winere_type = WinePropertyValuePeer::getWinesValueId(2);
    /**
     * hardcode end
     */
  }

  public function executeSearchResult(sfWebRequest $request)
  {
      $year = null;
      $winery = null;
      $winery_type = null;
      $this->pager = null;
      $limit_sort = sfConfig::get('app_max_search_limit');
      $this->winery = WinePropertyValuePeer::getWinesValueId(1);
      $this->winere_type = WinePropertyValuePeer::getWinesValueId(2);

      if($request->getParameter('year')) {
        $year = $request->getParameter('year');
      }
      if($request->getParameter('winery')) {
        $winery = $request->getParameter('winery');
      }
      if($request->getParameter('winery_type')) {
        $winery_type = $request->getParameter('winery_type');
      }
      $pager = new sfPropelPager('Wines', $limit_sort);
      $pager->setCriteria(WinesPeer::SearchWines($year, $winery, $wine_type));
      $pager->setPage($this->getRequestParameter('page', 1));
      $pager->init();
      $this->count_all_ads = WinesPeer::SearchWinesCountAll($year, $winery, $wine_type);
      $this->pager = $pager;
      $this->setTemplate('index');
  }
  
}
