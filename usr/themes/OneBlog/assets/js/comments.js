/**
 * Updated: 2025-03-12
 * Author: ©彼岸临窗 oneblogx.com
 *
 * 注释含命名规范，开源不易，如需引用请注明来源:彼岸临窗 https://oneblogx.com。
 * 本主题已取得软件著作权（登记号：2025SR0334142）和外观设计专利（专利号：第7121519号），请严格遵循GPL-2.0协议使用本主题。
 */

/** 评论无限加载 **/
document.addEventListener('DOMContentLoaded', function () {
    var commentList = document.querySelector('.comment-list');
    if (!commentList) return; // 如果当前页面不存在评论，则不执行该JS

    var isLoading = false;
    var noMoreComments = false;
    var loadingSpinner = document.getElementById('loading-spinner');
    var noMoreElement = document.getElementById('no-more');

    function loadMoreComments() {
        if (isLoading || noMoreComments) return;

        var nextPageUrl = document.querySelector('.page-navigator .next a')?.getAttribute('href');
        if (!nextPageUrl) {
            noMoreComments = true;
            noMoreElement.style.display = 'block';
            return;
        }

        isLoading = true;
        loadingSpinner.style.display = 'flex';

        setTimeout(function () { // 延迟0.5秒加载下一页
            var xhr = new XMLHttpRequest();
            xhr.open('GET', nextPageUrl, true);
            xhr.onload = function () {
                if (xhr.status >= 200 && xhr.status < 400) {
                    var tempDiv = document.createElement('div');
                    tempDiv.innerHTML = xhr.responseText;

                    var newComments = tempDiv.querySelector('.comment-list').innerHTML;
                    commentList.insertAdjacentHTML('beforeend', newComments);

                    var newNav = tempDiv.querySelector('.page-navigator').innerHTML;
                    document.querySelector('.page-navigator').innerHTML = newNav;

                    if (!tempDiv.querySelector('.page-navigator .next a')) {
                        noMoreComments = true;
                        noMoreElement.style.display = 'block';
                    }
                } else {
                    console.error('Request failed: ' + xhr.statusText);
                }
                isLoading = false;
                loadingSpinner.style.display = 'none';
            };
            xhr.onerror = function () {
                console.error('Request failed');
                isLoading = false;
                loadingSpinner.style.display = 'none';
            };
            xhr.send();
        }, 500); // 延迟0.5秒
    }

    window.addEventListener('scroll', function () {
        if (isLoading || noMoreComments) return;

        var scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
        var scrollHeight = document.documentElement.scrollHeight || document.body.scrollHeight;
        var clientHeight = document.documentElement.clientHeight || document.body.clientHeight;

        if (scrollTop + clientHeight >= scrollHeight - 200) {
            loadMoreComments();
        }
    });

    var initialNextPageUrl = document.querySelector('.page-navigator .next a')?.getAttribute('href');
    if (!initialNextPageUrl) {
        noMoreComments = true;
        noMoreElement.style.display = 'block';
    }
});