<?
function GetElements($arSection) {
    $itemsElement = GetIBlockElementList($arSection["IBLOCK_ID"], $arSection["ID"], array("SORT"=>"ASC"));

    while($arItem = $itemsElement->GetNext()) { 
        echo($arItem['NAME']);
        echo("<br />");
    }
}

$rsSections = CIBlockSection::GetList(array('SORT' => 'ASC'), array('DEPTH_LEVEL' => 1));
while($arSection = $rsSections->GetNext()) {
    GetElements($arSection);

    $rsParentSection = CIBlockSection::GetByID($arSection['ID']);
    if ($arParentSection = $rsParentSection->GetNext()) {
        $arFilter = array('IBLOCK_ID' => $arParentSection['IBLOCK_ID'],'>LEFT_MARGIN' => $arParentSection['LEFT_MARGIN'],'<RIGHT_MARGIN' => $arParentSection['RIGHT_MARGIN'],'>DEPTH_LEVEL' => $arParentSection['DEPTH_LEVEL']);
        $rsSect = CIBlockSection::GetList(array('left_margin' => 'asc'),$arFilter);

        while ($arSect = $rsSect->GetNext()) {
            GetElements($arSect);
        }
    }
}
?>