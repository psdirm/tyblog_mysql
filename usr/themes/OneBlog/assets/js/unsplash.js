/**
 * Updated: 2025-03-12
 * Author: ©彼岸临窗 oneblogx.com
 *
 * 注释含命名规范，开源不易，如需引用请注明来源:彼岸临窗 https://oneblogx.com。
 * 本主题已取得软件著作权（登记号：2025SR0334142）和外观设计专利（专利号：第7121519号），请严格遵循GPL-2.0协议使用本主题。
 */
let clickCount = 0;
let firstClickTime = null;
let customLoadingIndex = null;
document.getElementById('updateBtn').addEventListener('click', async function() {
    const now = new Date().getTime();
    if (!firstClickTime || now - firstClickTime > 60000) {
        // 重置计数器和时间
        firstClickTime = now;
        clickCount = 0;
    }
    clickCount++;
    if (clickCount > 10) {
        layer.msg('操作过于频繁，请稍后再试。', {icon: 2});
        return;
    }
    // 显示自定义加载框
    customLoadingIndex = layer.open({
        type: 1,
        content: '<div class="Syncing"><div class="loader"></div><span style="font-size: 14px;margin-top: 20px;">正在同步，请稍候...</span></div>',
        closeBtn: 0,
        shadeClose: false,
        shade: 0.5,
        skin: 'oneblog-unsplash-loading',
        title: false, // 不显示标题栏
    });
    try {
        let response = await fetch("?sync=1");
            layer.close(customLoadingIndex);
        if (response.ok) {
            let text = await response.text();
            var title;
            if (text.indexOf('请求超时') !== -1) {
                title = '⏳️&nbsp请求超时';
            } else if (text.indexOf('系统发生错误') !== -1) {
                title = '❌&nbsp;错误';    
            } else {
                title = '💡&nbsp;同步完成';
            } 
            layer.alert(text, {
                skin: 'oneblog-unsplash-loaded',
                title: title,
                closeBtn: 1,
                move: false, // 禁用弹框移动
                end: function() { // 弹框关闭时的回调
                    refreshPhotos();
                }
            });
        } else {
            layer.msg('系统发生错误，请稍后再试。', {icon: 2});
        }
    } catch (error) {
        layer.close(customLoadingIndex); // 发生错误时关闭自定义加载框
        layer.msg('系统发生错误，请稍后再试。', {icon: 2});
    }
});

async function refreshPhotos() {
    try {
        let response = await fetch("?refresh=1");
        if (response.ok) {
            let newPhotos = await response.text();
            document.getElementById('photos').innerHTML = newPhotos;
        } else {
            console.error('Failed to refresh photos');
        }
    } catch (error) {
        console.error('Error refreshing photos:', error);
    }
}