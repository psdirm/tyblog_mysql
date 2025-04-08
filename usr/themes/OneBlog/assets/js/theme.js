/**
 * Updated: 2025-03-12
 * Author: ©彼岸临窗 oneblogx.com
 *
 * 注释含命名规范，开源不易，如需引用请注明来源:彼岸临窗 https://oneblogx.com。
 * 本主题已取得软件著作权（登记号：2025SR0334142）和外观设计专利（专利号：第7121519号），请严格遵循GPL-2.0协议使用本主题。
 */
 
/**分类tab**/
document.addEventListener('DOMContentLoaded', function () {
    // Tab 配置
    const tabs = [
        { id: 'tab1', label: '主题说明', selector: null }, // 第一个 Tab 是静态内容
        { id: 'base', label: '基础设置', selector: '[id*="logo"],[id*="logoLight"],[id*="logowhite"],[id*="logoX"],[id*="slogan"],[id*="MenuSet"],[id*="Favicon"],[id*="switch"],[id*="Banner"],[id*="Menu"],[id*="NoPostIMG"],[id*="Webthumb"],[id*="Webtime"],[id*="Tongji"],[id*="ICP"],[id*="WA"]'},
        { id: 'pro', label: '高级设置', selector: '[id*="dnsPrefetch"],[id*="imgSmall"],[id*="BeCode"],[id*="F12"],[id*="RightClick"],[id*="Copy"],[id*="RandomIMG"],[id*="Unsplash_API"],[id*="Unsplash"],[id*="Unsplash_User"],[id*="Unsplash_Cat"]' },
        { id: 'social', label: '社交按钮', selector: '[id*="Xiaohongshu"],[id*="Weixin"],[id*="Email"],[id*="Github"]' },
        
    ];
    
    const form = document.querySelector('form'); 
    const tabContainer = document.getElementById('tab-container');
    const tabNav = document.getElementById('tab-nav');
    const tabContent = document.getElementById('tab-content');

    // 将 Tab 容器移动到表单中
    form.insertBefore(tabContainer, form.firstChild);
    // 生成 Tab 导航
    tabs.forEach((tab, index) => {
        const li = document.createElement('li');
        const a = document.createElement('a');
        a.href = `#${tab.id}`;
        a.textContent = tab.label;
        a.addEventListener('click', (e) => {
            e.preventDefault();
            switchTab(tab.id);
        });
        li.appendChild(a);
        tabNav.appendChild(li);

        // 生成 Tab 内容区域（第一个 Tab 已经存在，跳过）
        if (tab.id !== 'tab1') {
            const pane = document.createElement('div');
            pane.id = tab.id;
            pane.classList.add('tab-pane');
            tabContent.appendChild(pane);
        }
    });

    // 将字段移动到对应的 Tab 内容区域
    tabs.forEach(tab => {
        if (tab.selector) {
            const fields = document.querySelectorAll(tab.selector);
            const pane = document.getElementById(tab.id);
            fields.forEach(field => {
                pane.appendChild(field.closest('.typecho-option')); // 将整个字段容器移动到 Tab 内容区域
            });
        }
    });

    // 默认显示第一个 Tab
    switchTab(tabs[0].id);

    // 切换 Tab 的函数
    function switchTab(tabId) {
        // 隐藏所有 Tab 内容
        document.querySelectorAll('.tab-pane').forEach(pane => {
            pane.classList.remove('active');
        });

        // 显示当前 Tab 内容
        document.getElementById(tabId).classList.add('active');

        // 更新 Tab 导航的激活状态
        document.querySelectorAll('#tab-nav li a').forEach(a => {
            a.classList.remove('active');
        });
        document.querySelector(`#tab-nav a[href="#${tabId}"]`).classList.add('active');
    }
});

/**图标依赖**/
// 动态加载 iconfont.css
    function loadIconfont() {
      const link = document.createElement('link');
      link.rel = 'stylesheet';
      link.href = '//at.alicdn.com/t/c/font_3940454_u9s3lgsdiq.css'; // ONEBLOG图标库
      document.head.appendChild(link);
    }

    // 动态解析 iconfont.css
    async function loadAndParseIconfont() {
      const response = await fetch('//at.alicdn.com/t/c/font_3940454_u9s3lgsdiq.css');// ONEBLOG图标库
      const cssContent = await response.text();

      const iconRegex = /\.(icon-[^:]+):before\s*{\s*content:\s*"([^"]+)"/g;
      const icons = [];
      let match;

      while ((match = iconRegex.exec(cssContent)) !== null) {
        icons.push({
          className: match[1],
          unicode: match[2]
        });
      }

      return icons;
    }

    // 渲染图标
    function renderIcons(icons) {
      const iconList = document.getElementById('iconList');

      icons.forEach(icon => {
        const iconItem = document.createElement('div');
        iconItem.className = 'icon-item';

        const iconElement = document.createElement('i');
        iconElement.className = `iconfont ${icon.className}`;

        const classNameElement = document.createElement('span');
        classNameElement.textContent = icon.className;

        iconItem.appendChild(iconElement);
        iconItem.appendChild(classNameElement);
        iconList.appendChild(iconItem);
      });
    }

    // 初始化
    loadIconfont();
    loadAndParseIconfont().then(icons => {
      renderIcons(icons);
    });

    