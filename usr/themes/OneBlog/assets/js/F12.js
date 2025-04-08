/**
 * Updated: 2025-03-12
 * Author: ©彼岸临窗 oneblogx.com
 *
 * 注释含命名规范，开源不易，如需引用请注明来源:彼岸临窗 https://oneblogx.com。
 * 本主题已取得软件著作权（登记号：2025SR0334142）和外观设计专利（专利号：第7121519号），请严格遵循GPL-2.0协议使用本主题。
 */
 
document.addEventListener('DOMContentLoaded', function () {
    // 禁用复制功能
    if (disableCopy && !isLinksPage) {
        document.body.oncopy = function () {
            layer.msg('抱歉，本站内容不允许复制！');
            return false;
        };
    } else if (isLinksPage) {
        // 友链页面允许复制
        document.body.oncopy = function () {
            layer.msg('复制成功！');
        };
    }
    // 禁用右键菜单
    if (disableRightClick) {
        document.oncontextmenu = function (event) {
            layer.msg('右键菜单已禁用！');
            return false;
        };
    }
    // 禁用 F12 调试功能
    if (disableF12) {
        document.onkeydown = function (event) {
            // 检测 F12 按键
            if (event.keyCode === 123) {
                event.preventDefault();
                layer.msg('系统检测到异常，3秒后跳转至首页');
                setTimeout(function () {
                    window.location.href = "/"; // 3秒后跳转至首页
                }, 3000);
                return false;
            }
            // 检测 Ctrl+Shift+I (开发者工具)
            if (event.ctrlKey && event.shiftKey && event.keyCode === 73) {
                event.preventDefault();
                layer.msg('系统检测到异常，3秒后跳转至首页');
                setTimeout(function () {
                    window.location.href = "/"; // 3秒后跳转至首页
                }, 3000);
                return false;
            }
            // 检测 Ctrl+U (查看页面源代码)
            if (event.ctrlKey && event.keyCode === 85) {
                event.preventDefault();
                layer.msg('系统检测到异常，3秒后跳转至首页');
                setTimeout(function () {
                    window.location.href = "/"; // 3秒后跳转至首页
                }, 3000);
                return false;
            }
        };
    }
});