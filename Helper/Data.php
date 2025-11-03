<?php
/**
 * Catgento
 *
 * Do not edit or add to this file if you wish to upgrade to newer versions in the future.
 * If you wish to customize this module for your needs.
 *
 * @category   Catgento
 * @package    Catgento_AdminActivity
 */
namespace Catgento\AdminActivity\Helper;

use Magento\Framework\App\Config\ScopeConfigInterface;

/**
 * Class Data
 * @package Catgento\AdminActivity\Helper
 */
class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * @var string
     */
    const ACTIVITY_ENABLE = 'admin/activity/enable';

    /**
     * @var string
     */
    const LOGIN_ACTIVITY_ENABLE = 'admin/activity/login_activity';

    /**
     * @var string
     */
    const PAGE_VISIT_ENABLE = 'admin/activity/page_visit';

    /**
     * @var string
     */
    const CLEAR_LOG_DAYS = 'admin/activity/clearlog';

    /**
     * @var string
     */
    const BENCHMARK_ENABLE = 'admin/activity/benchmark';

    /**
     * @var string
     */
    const MODULE_ORDER = 'admin/activity/log/order';

    /**
     * @var string
     */
    const MODULE_PRODUCT = 'admin/activity/log/product';

    /**
     * @var string
     */
    const MODULE_CATEGORY = 'admin/activity/log/category';

    /**
     * @var string
     */
    const MODULE_CUSTOMER = 'admin/activity/log/customer';

    /**
     * @var string
     */
    const MODULE_PROMOTION = 'admin/activity/log/promotion';

    /**
     * @var string
     */
    const MODULE_EMAIL = 'admin/activity/log/email';

    /**
     * @var string
     */
    const MODULE_PAGE = 'admin/activity/log/page';

    /**
     * @var string
     */
    const MODULE_BLOCK = 'admin/activity/log/block';

    /**
     * @var string
     */
    const MODULE_WIDGET = 'admin/activity/log/widget';

    /**
     * @var string
     */
    const MODULE_THEME = 'admin/activity/log/theme';

    /**
     * @var string
     */
    const MODULE_SYSTEM_CONFIG = 'admin/activity/log/system_config';

    /**
     * @var string
     */
    const MODULE_ATTRIBUTE = 'admin/activity/log/attibute';

    /**
     * @var string
     */
    const MODULE_ADMIN_USER = 'admin/activity/log/admin_user';

    /**
     * @var string
     */
    const MODULE_SEO = 'admin/activity/log/seo';

    /**
     * @var \Catgento\AdminActivity\Model\Config
     */
    public $config;

    /**
     * @var array
     */
    public static $wildcardModels = [
        \Magento\Framework\App\Config\Value\Interceptor::class
    ];

    /**
     * Data constructor.
     * @param \Magento\Framework\App\Helper\Context $context
     * @param \Catgento\AdminActivity\Model\Config $config
     */
    public function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Catgento\AdminActivity\Model\Config $config
    ) {
        $this->config = $config;
        parent::__construct($context);
    }

    /**
     * Check and return status of module
     * @return bool
     */
    public function isEnable()
    {
        $status = $this->scopeConfig->isSetFlag(self::ACTIVITY_ENABLE, ScopeConfigInterface::SCOPE_TYPE_DEFAULT);
        if ($status == '1') {
            return true;
        }

        return false;
    }

    /**
     * Check and return status for login activity
     * @return bool
     */
    public function isLoginEnable()
    {
        $status = $this->scopeConfig->isSetFlag(self::ACTIVITY_ENABLE, ScopeConfigInterface::SCOPE_TYPE_DEFAULT);
        $loginStatus = $this->scopeConfig
            ->isSetFlag(self::LOGIN_ACTIVITY_ENABLE, ScopeConfigInterface::SCOPE_TYPE_DEFAULT);
        if ($status == '1' && $loginStatus == '1') {
            return true;
        }

        return false;
    }

    /**
     * Check and return status for page visit history
     * @return bool
     */
    public function isPageVisitEnable()
    {
        $status = $this->scopeConfig->isSetFlag(self::ACTIVITY_ENABLE, ScopeConfigInterface::SCOPE_TYPE_DEFAULT);
        $pageVisitStatus = $this->scopeConfig
            ->isSetFlag(self::PAGE_VISIT_ENABLE, ScopeConfigInterface::SCOPE_TYPE_DEFAULT);
        if ($status == '1' && $pageVisitStatus == '1') {
            return true;
        }

        return false;
    }

    /**
     * Get value of system config from path
     * @param $path
     * @return bool
     */
    public function getConfigValue($path)
    {
        if (strpos((string)$path, '::') !== false) {
            $moduleValue = $this->scopeConfig->isSetFlag(
                constant($path),
                ScopeConfigInterface::SCOPE_TYPE_DEFAULT
            );
        } else {
            $moduleValue = $this->scopeConfig->getValue(
                constant(
                    'self::'
                    . $path
                ),
                ScopeConfigInterface::SCOPE_TYPE_DEFAULT
            );
        }
        if ($moduleValue) {
            return $moduleValue;
        }
        return false;
    }

    /**
     * Get translated label by action name
     * @param string $action
     * @return string
     */
    public function getActionTranslatedLabel($action)
    {
        return $this->config->getActionLabel($action);
    }

    /**
     * Get all actions
     * @return array
     */
    public function getAllActions()
    {
        return $this->config->getActions();
    }

    /**
     * Get activity module name
     * @return bool
     */
    public function getActivityModuleName($module)
    {
        return $this->config->getActivityModuleName($module);
    }

    /**
     * Get module name is valid or not
     * @param $model
     * @return bool
     */
    public static function isWildCardModel($model)
    {
        $model = is_string($model)?$model:get_class($model);
        if (in_array($model, self::$wildcardModels)) {
            return true;
        }
        return false;
    }
}
