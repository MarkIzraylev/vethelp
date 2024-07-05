let timeout;
let selected_element_index = [0, 0];

$('[data-for-moving-block-id]').on('mousedown', function () {
    const thisBtn = $(this)
    moveMovingBlock(thisBtn)
    timeout = setInterval(function () {
        moveMovingBlock(thisBtn)
    }, 200);

    return false;
})

function moving_block_index(moving_block_id) {
    var index = -1;
    $('[data-moving-block-id]').each(function(i){
        if ($(this).attr('data-moving-block-id') == moving_block_id) {
            index = i;
            return false;
        }
    });
    return index;
}

function moveMovingBlock(thisBtn) {
    const fmbi = thisBtn.attr('data-for-moving-block-id')
    const currentShift = $(`[data-moving-block-id='${fmbi}']`).css('margin-left')

    $(`[data-moving-block-id='${fmbi}']`).children().removeClass('selected');

    if (thisBtn.attr('data-move-direction') == 'right') {
        let shift = $(`[data-moving-block-id='${fmbi}']`).children().eq(selected_element_index[moving_block_index(fmbi)] - 1).css('width');

        if (selected_element_index[moving_block_index(fmbi)] > 0) {
            $(`[data-moving-block-id='${fmbi}']`).css('margin-left', `calc(${currentShift} + ${shift} + 20px)`)
            selected_element_index[moving_block_index(fmbi)] -= 1;
        }
    } else if (thisBtn.attr('data-move-direction') == 'left') {
        let shift = $(`[data-moving-block-id='${fmbi}']`).children().eq(selected_element_index[moving_block_index(fmbi)]).css('width');
        if (selected_element_index[moving_block_index(fmbi)] < $(`[data-moving-block-id='${fmbi}']`).children().length - 1) {
            $(`[data-moving-block-id='${fmbi}']`).css('margin-left', `calc(${currentShift} - ${shift} - 20px)`)
            selected_element_index[moving_block_index(fmbi)] += 1;
        }
    } else {
        console.error(`Не задано направление движения перемещаемого кнопкой блока.`)
    }

    markDisabledMoveBtns(fmbi)

    $(`[data-moving-block-id='${fmbi}']`).children().eq(selected_element_index[moving_block_index(fmbi)]).toggleClass('selected');
}

function markDisabledMoveBtns(fmbi) {
    console.log(fmbi)
    let toRightBtn = $(`[data-for-moving-block-id='${fmbi}'][data-move-direction='right']`)
    let toLeftBtn = $(`[data-for-moving-block-id='${fmbi}'][data-move-direction='left']`)

    if (selected_element_index[moving_block_index(fmbi)] == 0) {
        toRightBtn.addClass('disabled')
    } else {
        toRightBtn.removeClass('disabled')
    }

    if (selected_element_index[moving_block_index(fmbi)] == $(`[data-moving-block-id='${fmbi}']`).children().length - 1) {
        toLeftBtn.addClass('disabled')
    } else {
        toLeftBtn.removeClass('disabled')
    }

    $(`[data-moving-block-id='${fmbi}']`).parent().parent().parent().children('.section__changing-content').children().css('display', 'none')

    if ($(`[data-moving-block-id='${fmbi}']`).parent().parent().parent().children('.section__changing-content').children().eq(selected_element_index[moving_block_index(fmbi)]).length != 0) {
        $(`[data-moving-block-id='${fmbi}']`).parent().parent().parent().children('.section__changing-content').children().eq(selected_element_index[moving_block_index(fmbi)]).css('display', 'grid')
    }
}

markDisabledMoveBtns('services')
markDisabledMoveBtns('specialists')

$(document).mouseup(function () {
    clearInterval(timeout);
    return false;
});

$(`[data-moving-block-id] > button`).on('click', function () {
    selected_element_index[moving_block_index($(this).parent().attr('data-moving-block-id'))] = $(this).index()
    $(`[data-moving-block-id]`).eq(moving_block_index($(this).parent().attr('data-moving-block-id'))).children().removeClass('selected');
    $(this).addClass('selected')
    let prevButtonsWidth = 0;
    $(`[data-moving-block-id]`).eq(moving_block_index($(this).parent().attr('data-moving-block-id'))).children('button').parent().children().slice(0, selected_element_index[moving_block_index($(this).parent().attr('data-moving-block-id'))]).each(function (ind, el) { prevButtonsWidth += Number($(el).css('width').slice(0, $(el).css('width').length - 2)); });
    $(`[data-moving-block-id]`).eq(moving_block_index($(this).parent().attr('data-moving-block-id'))).children('button').parent().css('margin-left', `calc(-${prevButtonsWidth}px - 20px * ${$(this).index()})`)
    selected_element_index[moving_block_index($(this).parent().attr('data-moving-block-id'))] = $(`[data-moving-block-id]`).eq(moving_block_index($(this).parent().attr('data-moving-block-id'))).children('button').parent().children().slice(0, selected_element_index[moving_block_index($(this).parent().attr('data-moving-block-id'))]).length
    markDisabledMoveBtns('specialists')
    markDisabledMoveBtns('services')
})