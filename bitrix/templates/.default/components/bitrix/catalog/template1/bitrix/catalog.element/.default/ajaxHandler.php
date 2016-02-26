<?
/*
echo '<pre>';
print_r($_POST);
echo '</pre>';
*/


require_once($_SERVER['DOCUMENT_ROOT'] .
	'/bitrix/modules/main/include/prolog_before.php');

if (($_SERVER['REQUEST_METHOD'] === 'POST') && !empty($_POST['ITEM_ID']))
{

	CModule::IncludeModule('iblock');

	$userId = $GLOBALS['USER']->GetID();
	$itemId = $_POST['ITEM_ID'];
	$res;

// по IRTEM_ID и USER_ID
	$tmp = CIBlockElement::GetList(
		array(),
		array(
			'IBLOCK_ID' => '4',
			'PROPERTY_ITEM_ID' => $itemId,
			'PROPERTY_USER_ID' => $userId
		),
		array()
	);


	if (!$tmp)
	{
		$arFields = array(
			'IBLOCK_ID' => '4',
	 		'NAME' => time(),
			'PROPERTY_VALUES' => array(
	  			'ITEM_ID' => $_POST['ITEM_ID'],
	  			'USER_ID' => $userId,
	 			)
	 	);

		$el = new CIBlockElement();
		$resInsert = $el->Add($arFields);
		$res = 'Success';
	} else {
		/* popup
			$(popup_id).show();
		$('.overlay').show();
		*/
		$res = 'Такой товар уже есть в Wishlistе';
	}

	if ((!$resInsert) && ($res === 'Success')) {
 		echo $el->LAST_ERROR;
	} else {
 		echo $res;
	}

}


?>