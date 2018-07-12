# Yii 2 快速开发脚手架


### 这是一个 YII2的 高级模版脚手架

- 本项目基于  [Yii 2 starter kit](https://github.com/trntv/yii2-starter-kit)进行了中文本地化优化，适合中国用户使用

### 主要优化包括以下几点

1. 加入docker的163镜像，加快docker速度

2. NPM包加入淘宝镜像，速度飞一样

3. 配置完成基于php7的 xdebug，方便调试



## 快速启动本项目
1. [安装 composer](https://getcomposer.org)
2. [安装 docker](https://docs.docker.com/install/)
3. [安装 docker-compose](https://docs.docker.com/compose/install/)
4. 运行
    ```bash
    进入到项目目录下
    cd project
    
    直接启动项目
    composer run-script docker:build
    
    ```
5. 访问前台应用 [http://www.localhost](http://www.localhost)
6. 访问前后台应用 [http://backend.localhost](http://backend.localhost)


## 演示
- 前台: [http://yii2-starter-kit.terentev.net](http://yii2-starter-kit.terentev.net)
- 后台: [http://backend.yii2-starter-kit.terentev.net](http://backend.yii2-starter-kit.terentev.net)

`administrator` role account
```
Login: webmaster
Password: webmaster
```

`manager` role account
```
Login: manager
Password: manager
```

`user` role account
```
Login: user
Password: user
```

## 备注
- 本项目基于  [Yii 2 starter kit](https://github.com/trntv/yii2-starter-kit)进行了中文本地化改进，欢迎大家指正!

## 推荐使用
- 本人开发的字典工具[yii2-dic](https://github.com/ciniran/yii2-dic)，能极大地提高复杂项目的开发效率，欢迎大家使用！
