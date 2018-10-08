<?php
/**
 *
 *
 * All rights reserved.
 *
 * @author Okulov Anton
 * @email qantus@mail.ru
 * @version 1.0
 * @date 08/10/2018 10:24
 */

namespace Modules\Meta\Interfaces;

use Phact\Components\MetaInterface;
use Phact\Orm\Model;

interface ModelMetaInterface extends MetaInterface
{
    /**
     * Fetch model-based metadata
     * @param Model $model
     * @return mixed
     */
    public function useModel(Model $model);
}