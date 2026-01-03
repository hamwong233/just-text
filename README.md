# Just Text

一个极简的WordPress单栏文本主题，使用 Tailwind CSS CDN。

## 特点

- 🎨 极简设计，专注内容阅读
- 📱 完全响应式布局
- 🔤 单栏设计，最佳阅读体验
- ⚡ 使用 Tailwind CSS CDN（无需构建）
- 📝 自定义 prose 样式优化文本排版
- 🚀 开箱即用，无需安装依赖

## 技术栈

- PHP (WordPress 模板系统)
- Tailwind CSS CDN

## 安装

### 1. 下载主题

将主题文件夹复制到 WordPress 安装目录的 `wp-content/themes/` 下。

### 2. 激活主题

在 WordPress 后台：
1. 进入 **外观** → **主题**
2. 找到 **Just Text** 主题
3. 点击 **激活**

就这么简单！无需安装任何依赖或构建工具。

## 文件结构

```
just-text/
├── footer.php                 # 页脚模板
├── functions.php              # 主题功能
├── header.php                 # 页头模板（包含 Tailwind CDN）
├── index.php                  # 首页/归档模板
├── page.php                   # 页面模板
├── single.php                 # 单篇文章模板
└── style.css                  # 主题信息（必需）
```

## 自定义

### 修改颜色和样式

编辑 `header.php` 中的 Tailwind 配置和自定义样式：

```javascript
tailwind.config = {
    theme: {
        extend: {
            colors: {
                // 添加自定义颜色
            }
        }
    }
}
```

### 修改最大宽度

在模板文件中查找 `max-w-2xl` 类，可替换为：
- `max-w-xl` - 更窄
- `max-w-3xl` - 更宽
- `max-w-4xl` - 很宽

### 添加导航菜单

1. 进入 WordPress 后台 → **外观** → **菜单**
2. 创建新菜单
3. 将菜单分配到 **Primary Menu** 位置

## 浏览器支持

- Chrome (最新版)
- Firefox (最新版)
- Safari (最新版)
- Edge (最新版)

## 许可证

GPL-2.0-or-later

## 作者

Your Name

## 更新日志

### 1.0.0 (2026-01-03)
- 初始版本发布
- 极简单栏设计
- Tailwind CSS 集成
- 响应式布局
