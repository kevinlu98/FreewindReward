<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

/**
 * Freewind主题专属打赏插件
 *
 * @package Freewind Reward
 * @author Mr丶冷文
 * @version 1.0.0
 * @link https://kevinlu98.cn/
 */
class FreewindReward_Plugin implements Typecho_Plugin_Interface
{
    /**
     * 激活插件方法,如果激活失败,直接抛出异常
     *
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function activate()
    {
        Typecho_Plugin::factory('Widget_Archive')->header = array('FreewindReward_Plugin', 'header');
        Typecho_Plugin::factory('Widget_Archive')->footer = array('FreewindReward_Plugin', 'footer');
        Typecho_Plugin::factory('freewind')->pjaxload = array('FreewindReward_Plugin', 'reload');
    }

    /**
     * 禁用插件方法,如果禁用失败,直接抛出异常
     *
     * @static
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function deactivate()
    {
    }

    /**
     * 获取插件配置面板
     *
     * @access public
     * @param Typecho_Widget_Helper_Form $form 配置面板
     * @return void
     */
    public static function config(Typecho_Widget_Helper_Form $form)
    {
        $wechat = new Typecho_Widget_Helper_Form_Element_Text(
            'wechat',
            NULL,
            'https://imagebed-1252410096.cos.ap-nanjing.myqcloud.com/203308/ec510fb0aa624278803bca68971cb7b5.png',
            _t('微信二维码'),
            "微信打赏二维码");
        $form->addInput($wechat);
        $alipay = new Typecho_Widget_Helper_Form_Element_Text(
            'alipay',
            NULL,
            'https://imagebed-1252410096.cos.ap-nanjing.myqcloud.com/203308/da1ad95f9d5f4b2db792350eda0414da.png',
            _t('支付宝二维码'),
            "支付宝打赏二维码");
        $form->addInput($alipay);
    }

    /**
     * 个人用户的配置面板
     *
     * @access public
     * @param Typecho_Widget_Helper_Form $form
     * @return void
     */
    public static function personalConfig(Typecho_Widget_Helper_Form $form)
    {
    }

    public static function header()
    {
        ?>
        <link rel="stylesheet"
              href="https://cdn.jsdelivr.net/gh/kevinlu98/FreewindReward@1.0/css/reward.min.css">
        <?php
    }

    public static function reload()
    {
        ?>
        $("div.neighbor").append(`<button id="freewind-reward-btn" type="button">赞赏</button>`)
        $(".neighbor").on('click', '#freewind-reward-btn', function () {
        $('.reward-cover').fadeIn()
        })

        <?php
    }

    public static function footer()
    {
        ?>
        <div class="reward-cover" style="display: none">
            <div class="reward-bg">
                <a href="javascript:void(0);" id="close-btn">
                    <svg t="1638894257378" class="icon" viewBox="0 0 1024 1024" version="1.1"
                         xmlns="http://www.w3.org/2000/svg" p-id="3371" width="20" height="20">
                        <path d="M872.802928 755.99406 872.864326 755.99406 872.864326 755.624646Z" p-id="3372"
                              fill="#777777"></path>
                        <path d="M927.846568 511.997953c0-229.315756-186.567139-415.839917-415.838893-415.839917-229.329059 0-415.85322 186.524161-415.85322 415.839917 0 229.300406 186.524161 415.84094 415.85322 415.84094C741.278405 927.838893 927.846568 741.29836 927.846568 511.997953M512.007675 868.171955c-196.375529 0-356.172979-159.827125-356.172979-356.174002 0-196.374506 159.797449-356.157629 356.172979-356.157629 196.34483 0 356.144326 159.783123 356.144326 356.157629C868.152001 708.34483 708.352505 868.171955 512.007675 868.171955"
                              p-id="3373" fill="#777777"></path>
                        <path d="M682.378947 642.227993 553.797453 513.264806 682.261267 386.229528c11.661597-11.514241 11.749602-30.332842 0.234337-41.995463-11.514241-11.676947-30.362518-11.765975-42.026162-0.222057L511.888971 471.195665 385.223107 344.130711c-11.602246-11.603269-30.393217-11.661597-42.025139-0.059352-11.603269 11.618619-11.603269 30.407544-0.059352 42.011836l126.518508 126.887922L342.137823 639.104863c-11.662621 11.543917-11.780301 30.305213-0.23536 41.96988 5.830799 5.89015 13.429871 8.833179 21.086248 8.833179 7.53972 0 15.136745-2.8847 20.910239-8.569166l127.695311-126.311801L640.293433 684.195827c5.802146 5.8001 13.428847 8.717546 21.056572 8.717546 7.599072 0 15.165398-2.917446 20.968567-8.659217C693.922864 672.681586 693.950494 653.889591 682.378947 642.227993"
                              p-id="3374" fill="#777777"></path>
                    </svg>
                </a>
                <h2>赞赏作者</h2>
                <div class="reward-btn-group">
                    <a href="javascript:void(0);" data-target="alipay-img" class="alipay-btn current">支付宝</a><a
                            href="javascript:void(0);" data-target="wechat-img"
                            class="alipay-btn">微信</a>
                </div>
                <div class="reward-img">
                    <img id="alipay-img"
                         src="<?php echo Typecho_Widget::widget('Widget_Options')->plugin('FreewindReward')->alipay ?>"
                         alt="">
                    <img id="wechat-img" style="display: none"
                         src="<?php echo Typecho_Widget::widget('Widget_Options')->plugin('FreewindReward')->wechat ?>"
                         alt="">
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/gh/kevinlu98/FreewindReward@1.0/js/reward.min.js"></script>
        <?php
    }

}
