/*!
 * jQuery pagination plugin v1.2.5
 * http://esimakin.github.io/twbs-pagination/
 *
 * Copyright 2014, Eugene Simakin
 * Released under Apache 2.0 license
 * http://apache.org/licenses/LICENSE-2.0.html
 */
;
(function ($, window, document, undefined) {

    'use strict';

    var old = $.fn.twbsPagination;

    // PROTOTYPE AND CONSTRUCTOR

    var TwbsPagination = function (element, options) {
        this.$element = $(element);
        this.$prevbtn = $('#previousBtn');
        this.$nxtbtn = $('#nextBtn');
        this.options = $.extend({}, $.fn.twbsPagination.defaults, options);

        if (this.options.startPage < 1 || this.options.startPage > this.options.totalPages) {
            throw new Error('Start page option is incorrect');
        }

        this.options.totalPages = parseInt(this.options.totalPages);
        if (isNaN(this.options.totalPages)) {
            throw new Error('Total pages option is not correct!');
        }

        this.options.visiblePages = parseInt(this.options.visiblePages);
        if (isNaN(this.options.visiblePages)) {
            throw new Error('Visible pages option is not correct!');
        }

        if (this.options.totalPages < this.options.visiblePages) {
            this.options.visiblePages = this.options.totalPages;
        }

        if (this.options.onPageClick instanceof Function) {
            this.$element.first().bind('page', this.options.onPageClick);
        }

        if (this.options.href) {
            var m, regexp = this.options.href.replace(/[-\/\\^$*+?.|[\]]/g, '\\$&');
            regexp = regexp.replace(this.options.hrefVariable, '(\\d+)');
            if ((m = new RegExp(regexp, 'i').exec(window.location.href)) != null) {
                this.options.startPage = parseInt(m[1], 10);
            }
        }

        this.$listContainer = $('<div class="panel-body" id="pageNoBox"></div>');

        this.$prevbtncontainer = $('<div></div>');
        this.$nxtbtncontainer = $('<div></div>');

        this.$listContainer.addClass(this.options.paginationClass);

        this.$element.append(this.$listContainer);

        this.$prevbtn.append(this.$prevbtncontainer);
        this.$nxtbtn.append(this.$nxtbtncontainer);

        this.render(this.getPages(this.options.startPage));
        this.setupEvents();

        return this;
    };

    TwbsPagination.prototype = {

        constructor: TwbsPagination,

        destroy: function () {
            this.$element.empty();
            this.$element.removeData('twbs-pagination');
            this.$element.unbind('page');
            return this;
        },

        show: function (page) {
            if (page < 1 || page > this.options.totalPages) {
                throw new Error('Page is incorrect.');
            }

            this.render(this.getPages(page));
            this.setupEvents();

            this.$element.trigger('page', page);
            return this;
        },

        buildListItems: function (pages) {
            var $listItems = $();

            for (var i = 0; i < pages.numeric.length; i++) {
                $listItems = $listItems.add(this.buildItem('page', pages.numeric[i]));
            }

            return $listItems;
        },

        buildListBtnPrev: function (pages) {
            var $listItems = $();

            if (this.options.prev) {
                var prev = pages.currentPage > 1 ? pages.currentPage - 1 : this.options.loop ? this.options.totalPages  : 1;
                $listItems = $listItems.add(this.buildItemPrevBtn('prev', prev));
            }

            return $listItems;
        },

        buildListBtnNxt: function (pages) {
            var $listItems = $();

            if (this.options.next) {
                var next = pages.currentPage < this.options.totalPages ? pages.currentPage + 1 : this.options.loop ? 1 : this.options.totalPages;
                $listItems = $listItems.add(this.buildItemNxtBtn('next', next));
            }

            return $listItems;
        },

        buildItem: function (type, page) {
            var itemContainer = $('<div class="col-md-3 col-xs-3 mrg-1"></div>'),
                itemContent = $('<a class="btn btn-default btn-circle btn-sm">1</a>'),
                itemText = null;

            switch (type) {
                case 'page':
                    itemText = page;
                    itemContainer.addClass(this.options.pageClass);
                    break;
                case 'first':
                    itemText = this.options.first;
                    itemContainer.addClass(this.options.firstClass);
                    break;
                case 'prev':
                    itemText = this.options.prev;
                    itemContainer.addClass(this.options.prevClass);
                    break;
                case 'next':
                    itemText = this.options.next;
                    itemContainer.addClass(this.options.nextClass);
                    break;
                case 'last':
                    itemText = this.options.last;
                    itemContainer.addClass(this.options.lastClass);
                    break;
                default:
                    break;
            }

            itemContainer.data('page', page);
            itemContainer.data('page-type', type);
            itemContainer.append(itemContent.attr('href', this.makeHref(page)).html(itemText));
            return itemContainer;
        },

        buildItemPrevBtn: function (type, page) {
            var itemContainer = $('<a class="btn btn-default btn-sm btn-block"></a>'),
                itemText = null;

            itemText = this.options.prev;
            itemContainer.addClass(this.options.prevClass);

            itemContainer.data('page', page);
            itemContainer.data('page-type', type);
            itemContainer.attr('href', this.makeHref(page)).html(itemText);
            return itemContainer;
        },

        buildItemNxtBtn: function (type, page) {
            var itemContainer = $('<a class="btn btn-default btn-sm btn-block"></a>'),
                itemText = null;

                itemText = this.options.next;
                itemContainer.addClass(this.options.nextClass);

            itemContainer.data('page', page);
            itemContainer.data('page-type', type);
            itemContainer.attr('href', this.makeHref(page)).html(itemText);
            return itemContainer;
        },

        getPages: function (currentPage) {
            var pages = [];

            var half = Math.floor(this.options.visiblePages / 2);
            var start = currentPage - half + 1 - this.options.visiblePages % 2;
            var end = currentPage + half;

            // handle boundary case
            if (start <= 0) {
                start = 1;
                end = this.options.visiblePages;
            }
            if (end > this.options.totalPages) {
                start = this.options.totalPages - this.options.visiblePages + 1;
                end = this.options.totalPages;
            }

            var itPage = start;
            while (itPage <= end) {
                pages.push(itPage);
                itPage++;
            }

            return {"currentPage": currentPage, "numeric": pages};
        },

        render: function (pages) {
            this.$listContainer.children().remove();
            this.$listContainer.append(this.buildListItems(pages));

            this.$prevbtncontainer.children().remove();
            this.$prevbtncontainer.append(this.buildListBtnPrev(pages));

            this.$nxtbtncontainer.children().remove();
            this.$nxtbtncontainer.append(this.buildListBtnNxt(pages));

            var children = this.$listContainer.children();
            var childrenprev = this.$prevbtncontainer.children();
            var childrennxt = this.$nxtbtncontainer.children();

            children.filter(function () {
                return $(this).data('page') === pages.currentPage && $(this).data('page-type') === 'page';
            }).addClass(this.options.activeClass);

            childrenprev.filter(function () {
                return $(this).data('page-type') === 'prev';
            }).toggleClass(this.options.disabledClass, !this.options.loop && pages.currentPage === 1);

            childrennxt.filter(function () {
                return $(this).data('page-type') === 'next';
            }).toggleClass(this.options.disabledClass, !this.options.loop && pages.currentPage === this.options.totalPages);
        },

        setupEvents: function () {
            var base = this;
            this.$listContainer.find('div').each(function () {
                var $this = $(this);
                $this.off();
                if ($this.hasClass(base.options.disabledClass) || $this.hasClass(base.options.activeClass)) {
                    $this.click(function (evt) {
                        evt.preventDefault();
                    });
                    return;
                }
                $this.click(function (evt) {
                    // Prevent click event if href is not set.
                    !base.options.href && evt.preventDefault();
                    base.show(parseInt($this.data('page'), 10));
                });
            });

            this.$prevbtncontainer.find('a').each(function () {
                var $this = $(this);
                $this.off();
                if ($this.hasClass(base.options.disabledClass) || $this.hasClass(base.options.activeClass)) {
                    $this.click(function (evt) {
                        evt.preventDefault();
                    });
                    return;
                }
                $this.click(function (evt) {
                    // Prevent click event if href is not set.
                    !base.options.href && evt.preventDefault();
                    base.show(parseInt($this.data('page'), 10));
                });
            });

            this.$nxtbtncontainer.find('a').each(function () {
                var $this = $(this);
                $this.off();
                if ($this.hasClass(base.options.disabledClass) || $this.hasClass(base.options.activeClass)) {
                    $this.click(function (evt) {
                        evt.preventDefault();
                    });
                    return;
                }
                $this.click(function (evt) {
                    // Prevent click event if href is not set.
                    !base.options.href && evt.preventDefault();
                    base.show(parseInt($this.data('page'), 10));
                });
            });
        },

        makeHref: function (c) {
            return this.options.href ? this.options.href.replace(this.options.hrefVariable, c) : "#";
        }

    };

    // PLUGIN DEFINITION

    $.fn.twbsPagination = function (option) {
        var args = Array.prototype.slice.call(arguments, 1);
        var methodReturn;

        var $this = $(this);
        var data = $this.data('twbs-pagination');
        var options = typeof option === 'object' && option;

        if (!data) $this.data('twbs-pagination', (data = new TwbsPagination(this, options) ));
        if (typeof option === 'string') methodReturn = data[ option ].apply(data, args);

        return ( methodReturn === undefined ) ? $this : methodReturn;
    };

    $.fn.twbsPagination.defaults = {
        totalPages: 0,
        startPage: 1,
        visiblePages: 5,
        href: false,
        hrefVariable: '{{number}}',
        first: 'First',
        prev: '←  Previous',
        next: 'Next  →',
        last: 'Last',
        loop: false,
        onPageClick: null,
        paginationClass: '',
        nextClass: 'next',
        prevClass: 'prev',
        lastClass: 'last',
        firstClass: 'first',
        pageClass: 'page',
        activeClass: 'active',
        disabledClass: 'disabled'
    };

    $.fn.twbsPagination.Constructor = TwbsPagination;

    $.fn.twbsPagination.noConflict = function () {
        $.fn.twbsPagination = old;
        return this;
    };

})(jQuery, window, document);