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
            if (node.getBoundingClientRect().top < 0) {
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
    let precent = parseInt(((window.innerHeight - directory.articleStart.getBoundingClientRect().bottom) / directory.articleHigh) * 100)
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