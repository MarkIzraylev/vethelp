let elements = $("[class$='--review']")

elements.each(function(ind, el) {
    if ($(el).children().eq(0).height() < $(el).children().eq(0).prop("scrollHeight") ||
    $(el).children().eq(0).width() < $(el).children().eq(0).prop("scrollWidth")) {
        // your element has overflow and truncated
        // show read more / read less button
        $(el).children().eq(1).css('display', 'block')
    } else {
        // your element doesn't overflow (not truncated)
    }
})

