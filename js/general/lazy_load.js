const blurDivs = $(".blur-load")
blurDivs.each((index, div) => {
    const img = $(".blur-load img")
    function loaded() {
        setTimeout(() => {
            div.classList.add("loaded")
          }, "200");
        
        //$(div).delay(1000).css("background-image", "url()")
        
    }
    if (img.complete) {
        loaded()
    } else {
        img.on("load", loaded)
    }
})