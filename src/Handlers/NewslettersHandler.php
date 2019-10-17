<?php
namespace Czim\HelloDialog\Handlers;

use Czim\HelloDialog\Contracts\newsletters\NewslettersInterface;
use Czim\HelloDialog\HelloDialogHandler;
use Exception;
use Log;
use Psr\Log\LoggerInterface;
use UnexpectedValueException;

class NewslettersHandler extends HelloDialogHandler implements NewslettersInterface
{
    const API_NEWSLETTERS   = 'newsletter';

    /**
     * Fetches the contents of a template, optionally performing placeholder replaces.
     *
     * @param int   $templateId
     * @param array $replaces
     * @return string
     */
    public function getTemplateContents($templateId, array $replaces = [])
    {
        $result = $this->getApiInstance(static::API_NEWSLETTERS)->get($templateId);

        $this->checkForHelloDialogError($result);

        $result = $result['html'];

        if (count($replaces)) {
            $result = str_replace(array_keys($replaces), array_values($replaces), $result);
        }

        return $result;
    }
}