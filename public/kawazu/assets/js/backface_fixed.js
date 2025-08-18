/**
 * Checks if the document's writing mode is vertical.
 * @returns {boolean} True if vertical writing mode, false otherwise.
 */
function isVerticalWritingMode() {
    const writingMode = window.getComputedStyle(document.documentElement).writingMode;
    return writingMode.includes("vertical");
}

/**
 * Calculates the width of the scrollbar.
 * @returns {number} The scrollbar width.
 */
function getScrollBarSize() {
    const scrollBarXSize = window.innerHeight - document.body.clientHeight;
    const scrollBarYSize = window.innerWidth - document.body.clientWidth;
    return isVerticalWritingMode() ? scrollBarXSize : scrollBarYSize;
}

/**
 * Gets the current scroll position.
 * @param {boolean} fixed - Indicates if the element is fixed.
 * @returns {number} The scroll position.
 */
function getScrollPosition(fixed) {
    return fixed
        ? isVerticalWritingMode()
            ? document.scrollingElement?.scrollLeft || 0
            : document.scrollingElement?.scrollTop || 0
        : parseInt(document.body.style.insetBlockStart || "0", 10);
}

/**
 * Applies styles to the body for backface fixed behavior.
 * @param {number} scrollPosition - The scroll position.
 * @param {boolean} apply - True to apply styles, false to remove.
 */
function applyStyles(scrollPosition, apply) {
    if (!apply) {
        document.body.style.cssText = "";
        return;
    }

    const isVertical = isVerticalWritingMode();
    document.body.style.cssText = `
      block-size: 100dvb;
      inline-size: 100dvi;
      position: fixed;
      inset-inline-start: 0;
      inset-block-start: ${isVertical ? `${scrollPosition}px` : `${-scrollPosition}px`};
    `;
}

/**
 * Restores the scroll position.
 * @param {number} scrollPosition - The scroll position to restore to.
 */
function restorePosition(scrollPosition) {
    window.scrollTo({
        behavior: "instant",
        ...(isVerticalWritingMode() ? { left: scrollPosition } : { top: -scrollPosition }),
    });
}

/**
 * Fixes or unfixes the backface, preventing or allowing scroll.
 * @param {boolean} fixed - True to fix, false to unfix.
 */
function backfaceFixed(fixed) {
    const scrollBarWidth = getScrollBarSize();
    const scrollPosition = getScrollPosition(fixed);
    document.body.style.paddingInlineEnd = fixed ? `${scrollBarWidth}px` : "";
    applyStyles(scrollPosition, fixed);
    if (!fixed) {
        restorePosition(scrollPosition);
    }
}
