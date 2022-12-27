<?php

declare(strict_types=1);

/*
 * @copyright  trilobit GmbH
 * @author     trilobit GmbH <https://github.com/trilobit-gmbh>
 * @license    LGPL-3.0-or-later
 */

namespace Trilobit\ConstantsBundle\Model;

use Contao\Date;
use Contao\Model;

/**
 * Class SocialmediaModel.
 */
class ConstantsModel extends Model
{
    /**
     * $strTable.
     */
    protected static $strTable = 'tl_constants';

    /**
     * @param $intId
     * @param mixed $strName
     *
     * @return mixed
     */
    public static function findPublishedByName($strName, array $arrOptions = [])
    {
        $t = static::$strTable;
        $arrColumns = ["$t.name=?"];

        if (!static::isPreviewMode($arrOptions)) {
            $time = Date::floorToMinute();
            $arrColumns[] = "$t.published=1 AND ($t.start='' OR $t.start<='$time') AND ($t.stop='' OR $t.stop>'$time')";
        }

        $arrColumns[] = "$t.tstamp!=0";

        /*
        if (isset($arrOptions['ignoreFePreview']) || !BE_USER_LOGGED_IN) {
            $time = \Date::floorToMinute();
            $arrColumns[] = "($t.start='' OR $t.start<='$time') AND ($t.stop='' OR $t.stop>'".($time + 60)."') AND $t.published='1'";
        }
        */

        return static::findOneBy($arrColumns, $strName, $arrOptions);
    }
}
