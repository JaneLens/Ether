# 前言
图片加载不出来？加载太慢？可以前往https://amrx.me/214浏览

# 更新

1. 2025/03/23 02：58分
成功完成无限流加载 问题：ajax评论没实现成功
2. 2025/03/24 03：31分
ajax的评论搞定 请关闭后台的反垃圾保护 问题：太多评论出现无限流之后的评论会错乱
3. 2025/03/25 02：20分
太多评论出现无限流之后的评论会错乱搞定 我已经开始怀疑ajax真的有必要存在么 问题：前台登入改成获取访客的历史评论未完成
4. 2025/03/25 18：37分
ajax出现大bug 去掉了 不想搞 累了累了 暂时把问题交给 未来的我 托管 据说它比现在的我聪明10个版本号
5. 2025/03/27 23：05分
访客的历史评论完成 没有评论过会显示“还没有评论 留个脚印吧~” 管理员登入不显示 添加了文章置顶功能 美化评论代码 给代码添加了按钮 实现弹出代码
![image](https://github.com/user-attachments/assets/5daec4c5-3d9c-4de1-a5a1-257ea02d4727)
![image](https://github.com/user-attachments/assets/7c333f21-fa39-4779-a434-50aad8d23a40)
后台必须要填写允许使用HTML标签和属性
![image](https://github.com/user-attachments/assets/ee04a0a1-c19e-4db9-8161-830fb8ef8951)
![image](https://github.com/user-attachments/assets/df5fd8e7-935c-4459-bd5e-7a0f5c3f22e1)

# Ether正确食用方式：

**关于导航**

支持二级分类 请尽量减少一级分类 在使用图标的情况下最多不超五个 否则平板端会显的拥挤 如下图：

![image](https://github.com/user-attachments/assets/ba4f2b33-bf6a-4411-8c2d-f3bd4e98b577)

不推荐使用二级页面（没有折腾相关css 会出事）页面导航都存放专题里 倘若你想给专题添加图标 建议修改文件
![image](https://github.com/user-attachments/assets/700a8079-d3b7-4471-ad0b-8b7a10defcc7)

**评论加载**

发现评论加载按钮点击没有反应 问题很大可能出现在后台设置上 如下图设置 确保F12看到的代码是一致的
![image](https://github.com/user-attachments/assets/be74a707-0683-4202-b16e-c3a569ca1f41)
![image](https://github.com/user-attachments/assets/6a20572c-23b9-46c0-a908-fae5cc4b25c0)

**文章类型**

为什么发现输出的都是文章模板 问题绝对是出现在 后台写文的时候没有修改自定义字段里的文章类型

![image](https://github.com/user-attachments/assets/2151ea1d-166b-4ee8-b66a-2767f8905946)

# 三视图

![image](https://github.com/user-attachments/assets/b54d3c4e-fe63-4f25-bac5-240ee86ddfad)
