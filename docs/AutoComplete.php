<?php

namespace MiaoxingDoc\WxaCode {

    /**
     * @property    \Miaoxing\WxaCode\Service\WxaCode $wxaCode
     *
     * @property    \Miaoxing\WxaCode\Service\WxaCodeLogModel $wxaCodeLogModel WxaCodeLogModel
     * @method      \Miaoxing\WxaCode\Service\WxaCodeLogModel|\Miaoxing\WxaCode\Service\WxaCodeLogModel[] wxaCodeLogModel()
     *
     * @property    \Miaoxing\WxaCode\Service\WxaCodeModel $wxaCodeModel WxaCodeModel
     * @method      \Miaoxing\WxaCode\Service\WxaCodeModel|\Miaoxing\WxaCode\Service\WxaCodeModel[] wxaCodeModel()
     */
    class AutoComplete
    {
    }
}

namespace {

    /**
     * @return MiaoxingDoc\WxaCode\AutoComplete
     */
    function wei()
    {
    }

    /** @var Miaoxing\WxaCode\Service\WxaCode $wxaCode */
    $wxaCode = wei()->wxaCode;

    /** @var Miaoxing\WxaCode\Service\WxaCodeLogModel $wxaCodeLogModel */
    $wxaCodeLog = wei()->wxaCodeLogModel();

    /** @var Miaoxing\WxaCode\Service\WxaCodeLogModel|Miaoxing\WxaCode\Service\WxaCodeLogModel[] $wxaCodeLogModels */
    $wxaCodeLogs = wei()->wxaCodeLogModel();

    /** @var Miaoxing\WxaCode\Service\WxaCodeModel $wxaCodeModel */
    $wxaCode = wei()->wxaCodeModel();

    /** @var Miaoxing\WxaCode\Service\WxaCodeModel|Miaoxing\WxaCode\Service\WxaCodeModel[] $wxaCodeModels */
    $wxaCodes = wei()->wxaCodeModel();
}
