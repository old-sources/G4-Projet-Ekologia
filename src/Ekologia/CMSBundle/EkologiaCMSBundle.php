<?php

namespace Ekologia\CMSBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class EkologiaCMSBundle extends Bundle
{
    public function getParent() {
        return 'EkologiaArticleBundle';
    }
}
