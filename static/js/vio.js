function ready(fn) {
    //当页面加载完成时
    if (document.readyState !== 'loading') {
        fn();
    } else {
        document.addEventListener('DOMContentLoaded', fn);
    }
}
let directory = {
    highLight: null,
    articleStart: null,
    articleEnd: null,
    articleHigh: 0,
    precent: 0,
    list: [],
}
let navigationBar = {
    status: true, //显示状态
    anchor: 0, //锚点
    hide: false //强制隐藏
}
ready(() => {
    //目录
    let last = document.getElementById('directory_body')
    if (last) {
        //有文章，在文章页
        last.level = 0
        //for of
        for (node of document.querySelectorAll('article *')) {
            nodeName = node.nodeName
            title = document.createElement('p')
            title.appendChild(document.createElement('span'))
            if (nodeName.charAt(0) == 'H') {
                let level = nodeName.charAt(1)
                while (!node.firstChild.data) {
                    node = node.firstChild
                    //可能会有一些格式嵌套
                }
                title.firstChild.innerHTML = node.firstChild.data
                console.log(nodeName, title)
                if (level == '1') {
                    //事标题？    233
                    document.getElementById('directory-title').innerHTML = node.firstChild.data
                } else {
                    //标题点击滚动
                    (() => {
                        let packNode = node
                        title.onclick = (e) => {
                            navigationBar.hide = true
                            packNode.scrollIntoView({ behavior: "smooth", duration: 7000 })
                            setTimeout(() => { navigationBar.hide = false }, 3000)
                            e.stopPropagation()
                        }
                    })()
                    if (last.nodeName == 'DIV' || last.level < level) {
                        //插入子节点
                        last.appendChild(title)
                        console.log('add', level, last)
                    } else if (last.level == level) {
                        last.parentNode.appendChild(title)
                    } else if (last.level > level) {
                        //插入父节点
                        for (let i = 0; i < last.level - level; i++) {
                            last = last.parentNode
                        }
                        last.parentNode.appendChild(title)

                    }
                    last = title
                    last.level = level
                    directory.list.push([node, title])
                }
            }
        }
        console.log("ok")
        directory.articleStart = document.querySelector('#startanchor')
        directory.articleEnd = document.querySelector('#endanchor')
        directory.articleHigh = (directory.articleEnd.getBoundingClientRect().bottom - directory.articleStart.getBoundingClientRect().bottom)
        console.log(directory.articleHigh, directory.articleStart.getBoundingClientRect().bottom, directory.articleEnd.getBoundingClientRect().bottom)
        directoryScroll()
    }

})

function directoryScroll() {
    if (directory.list[0]) {
        //刷线目录状态2
        let highLight = directory.list[0][1]
        for ([node, title] of directory.list) {
            if (node.getBoundingClientRect().top < 50) {
                highLight = title
            } else {
                break
            }
        }
        if (highLight != directory.highLight) {
            if (directory.highLight) {
                directory.highLight.classList.remove('active')
            }
            highLight.classList.add('active')
            directory.highLight = highLight
        }
    }
    let precent = ((window.innerHeight - directory.articleStart.getBoundingClientRect().bottom) / directory.articleHigh) * 100
    //文章百分比
    if (directory.articleStart.getBoundingClientRect().top < 10
    ) {
        //到达正文，开始隐藏导航栏
        if (navigationBar.status && (navigationBar.anchor == 0 || precent - navigationBar.anchor > 0) || navigationBar.hide) {
            let timeout = 0
            if (navigationBar.anchor == 0) {
                timeout = 4000;
            }
            setTimeout(() => {
                navigationBar.status = false
                document.querySelector('#header').classList.add('menu-hide')
            }, timeout)
        } else if ((!navigationBar.status) && (navigationBar.anchor == 0 || navigationBar.anchor - precent > 0)) {
            navigationBar.status = true
            document.querySelector('#header').classList.remove('menu-hide')
        }
        navigationBar.anchor = precent
    }
    precent = precent.toFixed(0);
    if (precent > 100) {
        precent = 100
    } else if (precent < 0) {
        precent = 0
    }
    if (directory.precent != precent) {
        document.querySelector('.helper .precent').innerHTML = precent + '%'
        directory.precent = precent
    }
    setTimeout(directoryScroll, 100)
}

ready(() => {
    if (document.querySelector("#tool_random")) {
        document.querySelector("#tool_random").onclick = () => {
            let list = document.querySelectorAll('#bar_article_list a')
            list[Math.floor(Math.random() * list.length)].click()
        }
    }
    document.getElementById('menu_button').onclick = () => {
        let header = document.getElementById('header');
        header.classList.toggle('menu-show')
        toggleMask()
    }
    document.getElementById('open_sidebar').onclick = () => {
        // 切换状态
        let sidebar = document.querySelector('.sidebar');
        sidebar.classList.toggle('show')
        document.querySelector('#float_action_buttons').classList.toggle('menu-show')
        toggleMask()
    }
    document.querySelector('.mask').addEventListener('touchstart',() => {
        closeAll()
    })
    document.getElementById('back_to_top').onclick = () => {
        window.scrollTo({ top: 0, behavior: 'smooth' })
    }
})

function toggleMask() {
    document.querySelector('.mask').classList.toggle('show')
}

function closeAll() {
    document.querySelector('#header').classList.remove('menu-show')
    document.querySelector('#float_action_buttons').classList.remove('menu-show')
    document.querySelector('.sidebar').classList.remove('show')
    document.querySelector('.mask').classList.remove('show')
}