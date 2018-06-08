<?php

namespace App\Http\Controllers;

class AreaController extends Controller
{
    public function show()
    {
        $areaList = \App\Area::with('governorate')->get()->toArray();
            $areaToShow = array();
            foreach ($areaList as $area) {
                $areaId = $area['id'];
                $areaToShow[$areaId] = new \stdClass();
                $areaToShow[$areaId]->id = $area['id'];
                $areaToShow[$areaId]->area = $area['area'];
                $areaToShow[$areaId]->coordinates = $area['coordinates'];
                $areaToShow[$areaId]->created_at = $area['created_at'];
                $areaToShow[$areaId]->updated_at = $area['updated_at'];
                $areaToShow[$areaId]->areaInArabic = $area['areaInArabic'];
                $areaToShow[$areaId]->governorate_id = $area['governorate']['id'];
                $areaToShow[$areaId]->governorate = $area['governorate']['governorate'];
            }
            return array_values($areaToShow);
   }
}
