## PHP imgserv

一个使用PHP编写的占位图生成服务，使用方便，操作简单，前端页面构建的好帮手。

### 演示

* [占位图生成工具(seejs)](http://www.seejs.com/imgserv/about.html)
* [占位图生成工具(Github Pages)](http://mailzwj.github.io/imgserv)

### 参数说明

```
// 请求地址示例
http://www.seejs.com/imgserv/?size=400x200&bgc=333&fz=20&text=abcde&fc=f00
```

- `size`: 生成图片的尺寸 Width x Height
- `bgc`: background-color 生成图片背景颜色，支持abc和abcdef两种十六进制格式
- `fz`: font-size 绘制文本的字体大小，默认 20
- `text`: 绘制的文本内容，默认为传入的尺寸
- `fc`: font-color 绘制文本的颜色，默认 fff

### 使用示例

![IMGSERV](http://www.seejs.com/imgserv/?size=860x120&bgc=39f&fz=20&text=Github&fc=fff "IMGSERV")
