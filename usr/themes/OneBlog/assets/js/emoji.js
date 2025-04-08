/**
 * Updated: 2025-03-12
 * Author: ©彼岸临窗 oneblogx.com
 *
 * 注释含命名规范，开源不易，如需引用请注明来源:彼岸临窗 https://oneblogx.com。
 * 本主题已取得软件著作权（登记号：2025SR0334142）和外观设计专利（专利号：第7121519号），请严格遵循GPL-2.0协议使用本主题。
 */
 
document.addEventListener('DOMContentLoaded', function() {
    const emojiBtn = document.getElementById('emoji-btn');
    const emojiPicker = document.getElementById('emoji-picker');
    const textarea = document.getElementById('textarea');
    const emojiContainer = document.querySelector('.emoji-container');
    const emojiCategories = document.querySelectorAll('.emoji-category');
    // 如果页面上没有表情按钮，则直接退出，不执行后面的代码
    if (!emojiBtn || !emojiPicker || !textarea || !emojiContainer || emojiCategories.length === 0) {
          return;
    }
    let lastActiveCategory = 'emotion'; // 默认分类

    // 表情分类及其对应的表情图标和颜文字
    const emojiData = {
        emotion: [
            '101.svg','102.svg','103.svg','104.svg','105.svg','106.svg','107.svg',
            '108.svg','109.svg','110.svg','111.svg','112.svg','113.svg','114.svg',
            '115.svg','116.svg','117.svg','118.svg','119.svg','120.svg','121.svg',
            '122.svg','123.svg','124.svg','125.svg','126.svg','127.svg','128.svg',
            '129.svg','130.svg','131.svg','132.svg','133.svg','134.svg',
        ],
        special: [
            '201.svg','202.svg','203.svg','204.svg','205.svg','206.svg','207.svg',
            '208.svg','209.svg','210.svg',
        ],
        kaomoji: [
            '(✪ω✪)','(*^▽^*)','٩(๑❛ᴗ❛๑)۶',
            '(๑´ㅂ`๑) ','(｡◕ˇ∀ˇ◕)','(◕ᴗ◕✿)',
            '(๑¯∀¯๑)','(＾ω＾)','(★ᴗ★)',
            '(*^__^*) ','(╯︵╰)','(T＿T)',
            '╥﹏╥','(｡•́︿•̀｡)','>_<',
            '(•ˇ‸ˇ•｡)','｡◕ᴗ◕｡','(´•༝•`)',
        ]
    };

    // 加载表情图标或颜文字
    function loadEmojis(category) {
        emojiContainer.innerHTML = ''; // 清空当前的表情图标或颜文字
        const emojis = emojiData[category];
        emojis.forEach(emoji => {
            if (category === 'kaomoji') {
                const span = document.createElement('span');
                span.textContent = emoji;
                span.className = 'kaomoji';
                emojiContainer.appendChild(span);
                span.addEventListener('click', () => {
                    insertAtCaret(textarea, emoji);
                    emojiPicker.style.display = 'none';
                    clearActiveClass(); // 清除active类
                });
            } else {
                const img = document.createElement('img');
                img.src = `/usr/themes/OneBlog/assets/img/emoji/${emoji}`;
                img.alt = emoji;
                emojiContainer.appendChild(img);
                img.addEventListener('click', () => {
                    const emojiName = emoji.replace('.svg', '');
                    const shortcode = `[emoji:${emojiName}]`;
                    insertAtCaret(textarea, shortcode);
                    emojiPicker.style.display = 'none';
                    clearActiveClass(); // 清除active类
                });
            }
        });
    }

    // 显示或隐藏表情选择器
    emojiBtn.addEventListener('click', () => {
        if (emojiPicker.style.display === 'none') {
            emojiPicker.style.display = 'block';
            loadEmojis(lastActiveCategory); // 加载上次选择的分类的表情图标或颜文字
            setActiveClass(lastActiveCategory); // 恢复上次选择的active类
        } else {
            emojiPicker.style.display = 'none';
            clearActiveClass(); // 清除active类
        }
    });

    // 切换表情分类
    emojiCategories.forEach(button => {
        button.addEventListener('click', (event) => {
            event.preventDefault(); // 阻止表单提交
            const category = button.getAttribute('data-category');
            lastActiveCategory = category; // 更新上次选择的分类
            loadEmojis(category);
            setActiveClass(category);
        });
    });

    // 点击页面其他位置时隐藏表情选择器
    document.addEventListener('click', (event) => {
        if (!emojiPicker.contains(event.target) && event.target !== emojiBtn) {
            emojiPicker.style.display = 'none';
            clearActiveClass(); // 清除active类
        }
    });

    // 清除所有active类
    function clearActiveClass() {
        emojiCategories.forEach(btn => btn.classList.remove('active'));
    }

    // 设置active类
    function setActiveClass(category) {
        emojiCategories.forEach(button => {
            if (button.getAttribute('data-category') === category) {
                button.classList.add('active');
            } else {
                button.classList.remove('active');
            }
        });
    }

    // 在光标位置插入短代码或颜文字
    function insertAtCaret(textarea, text) {
        if (document.selection) {
            // IE
            textarea.focus();
            const sel = document.selection.createRange();
            sel.text = text;
            textarea.focus();
        } else if (textarea.selectionStart || textarea.selectionStart === 0) {
            // 其他浏览器
            const startPos = textarea.selectionStart;
            const endPos = textarea.selectionEnd;
            const scrollTop = textarea.scrollTop;
            textarea.value = textarea.value.substring(0, startPos) + text + textarea.value.substring(endPos, textarea.value.length);
            textarea.focus();
            textarea.selectionStart = startPos + text.length;
            textarea.selectionEnd = startPos + text.length;
            textarea.scrollTop = scrollTop;
        } else {
            textarea.value += text;
            textarea.focus();
        }
    }
});