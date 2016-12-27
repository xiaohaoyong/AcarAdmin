#版本更新说明:

##v1.4.5 @ 2016-12-01
###新功能

- GNU风格的版本号命名格式: 主版本号.子版本号.修正版本号
- [demo] 好友之间可以通过webrtc进行视频聊(仅支持 https + Webkit浏览器)
- [demo] 支持同一账号最多8个标签页登录 `isMultiLoginSessions:true`
- [demo] http访问加入ip策略功能,防止DNS劫持  `isHttpDNS:true`
- [sdk]  新增 cdn 和npm package 两种安装引用方式
    - 引用 cdn 文件
    ```
    <script src='http://downloads.easemob.com/downloads/cdn/websdk-1.4.5.js'></script>
    或者
    <script src='http://downloads.easemob.com/downloads/cdn/websdk-1.4.5.min.js'></script>
    ```
    - npm package 安装和引用
    ```
    先安装npm package
    npm install easemob-websdk --save
    
    然后在js文件中引用
    require('easemob-websdk'); 

    ```
###Bug修复

- [sdk] 解散群组不更新UI
- [sdk] 修复了发送cmd消息成功后无法调用回调函数的bug



##v1.1.3 @ 2016-11-01

* [demo] 支持 Windows SDK. <http://www.easemob.com/download/im>
* [demo] 新增黑名单功能.
* [demo] 获取聊天室列表: 支持分页,下拉刷新,新增以下2个参数：pagenum 和 pagesize。
* [demo] 调试更方便，webpack 支持开发和生产模式.
    * `npm run dev` , 开发模式, 支持热加载, 启动一个供调试的webserve http://localhost:3000.
    * `npm run prod`, 生产模式, 编译速度更快.
* [demo] 群组增加以下功能：创建群组, 修改群组名称, 修改群组简介, 群组成员管理, 加入公开群.
* [sdk] strophe 从 v1.2.2 升级到 v1.2.8，在生产模式使用 strophe-1.2.8.min.js， 在开发模式使用 strophe.js.
* [sdk] 支持自动重连: 在 webim.config.js 文件中新增相关参数 `autoReconnectNumMax` 和 `autoReconnectInterval`.

* Bug修复:
    1. [demo] 增加 `babel-core/browser-polyfill.js`文件，修复了 IE 不支持 HTML5 element 的 bug。
    2. [demo] 修复了有未读消息时点击联系人不生效的bug。
    3. [sdk] 修复了strophe.js v1.2.8在IE9中使用BOSH会报错的bug。  <https://github.com/strophe/strophejs/issues/213>
    4. [sdk] 修复了存在大量离线消息时收发消息延迟的bug。客户端将发送ack应答消息的速度限制在5个/秒，不影响其他正常消息。
    5. [sdk] 将心跳消息从 空body的json message 切换为 ping/pong iq。前者会作为离线消息被XMPP Server缓存。
   
   
---
#ChangeLog:

##v1.4.5 @ 2016-12-01

###Feature

- GNU version number: `Major_Version_Number.Minor_Version_Number.Revision_Number`
- [demo] friends can video chat to each other (support https + Webkit only)
- [demo] limite of a single user the number of opened tabs in the same browser `isMultiLoginSessions:true`
- [demo] while http access,use ip directly instead of ServerName,avoid DNS hijacking.  `isHttpDNS:true`

###BugFix

- [sdk] does not update catact list UI after destory group
- [sdk] does not call the callback function after send out the cmd message

##v1.1.3 @ 2016-11-01

* [demo] support Windows SDK. <http://www.easemob.com/download/im>
* [demo] add blacklist feature.
* [demo] paging getChatrooms, add 2 params:pagenum and pagesize. 
* [demo] easy debug, webpack support development and production mode。
    * `npm run dev`  debug mode, support hot reload, start a webserver and listen at http://localhost:3000.
    * `npm run prod` product mode, faster than before.
* [demo] groups add features: createGroup,changeGroupSubject,changeGroupDesc,adminGroupMembers,joinPublicGroup.
* [sdk]  upgrade strophe from v1.2.2 to v1.2.8, and use strophe-1.2.8.min.js in the product mode, use strophe.js in the debug mode.
* [sdk]  auto reconnect while configured `autoReconnectNumMax` and `autoReconnectInterval` in webim.config.js.

* Bug fixes:
    1. [demo] Fixed a bug of HTML5 elements are not supported in IE by add `babel-core/browser-polyfill.js`.
    2. [demo] Fixed a bug of friends contact is not clickable while there are unread messages.
    3. [sdk] Fixed a bug of strophe.js v1.2.8 using BOSH in IE9.  <https://github.com/strophe/strophejs/issues/213>
    4. [sdk] Fixed a bug of send/receive message delay while there was a lot of offline messages.Client should limit the speed of sending ack messages  up to 5/s, the other nomal send/recv will not be influenced.
    5. [sdk] switch heartBeat from empty body json message to ping/pong iq, the former will be cached as offline message by XMPP Server.

