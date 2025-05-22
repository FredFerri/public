var today       = new Date();
var endcal      = new Date();
endcal.setMonth(endcal.getMonth() + 3);
console.log(endcal);
var periodpickerOptionsRange = {
    end: "#datepickerend",
    timepicker: true,
    tabIndex: 0,
    minDate: today,
    maxDate: endcal,
    formatDate: 'DD-MM-YYYY',
    formatDateTime: 'DD-MM-YYYY',
    norange: true,
    timepicker:false,
    todayButton:true,
    yearsLine: false,
    showDatepickerInputs: false,
    animation: true,
    withoutBottomPanel: true,
    resizeButton: false,
    fullsizeButton: false,
    fullsizeOnDblClick: false,
    clearButtonInButton: true,
    okButton: false,
    cells: [1, 2],
    lang: "fr",
    i18n: {
        fr: {
            'Today': 'Aujourd\'hui'
        }
    }
};
jQuery('#datepicker')
    .periodpicker(periodpickerOptionsRange)
    .on('change', function () {
        var start = jQuery("#datepicker").val();
        var end   = jQuery("#datepickerend").val();
        /*if (end === '' || start === end){
            filterdates(start,end);
        }
        else if (start === '' && end === '') {
            cleardate();
        }
        else{
            filterdate(start);
        }*/
        filterdate(start);
    });
jQuery('#category').selectize({
    onChange: function (){

        contains = jQuery("#category").val();
        //console.log(contains);
        if (contains === null)
        {
            clearcat('');
        }
        else
        {
            for (const selectedcat of contains) {
                //console.log("lenght : " + contains.length);
                //console.log("selected : " + selectedcat);
                filtercat(selectedcat);
            }
        }
    }
});
jQuery('#city').selectize({
    onChange: function (){

        contains = jQuery("#city").val();
        //console.log(contains);
        if (contains === null)
        {
            clearzip('');
        }
        else
        {
            for (const selectedcat of contains) {
                //console.log("lenght : " + contains.length);
                //console.log("selected : " + selectedcat);
                filterzip(selectedcat);
            }
        }
    }
});
cat2display = [];
for(const todisplay of catprefs.category)
{
    if (todisplay.display === 1)
    {
        cat2display.push(todisplay.id);
    }
}
//console.log(cat2display);


function makeBloc(data)
{
    var htmlcontent = jQuery(".results-agenda");
    var types       = "type-" + data.categories.main.id;
    var categories  = data.categories.main.id;
    var display     = 0;
    var parenthide  = 0;
    if (cat2display.includes(categories))
    {
        display     = 1;
    }
    else{
        parenthide  = 1;
    }
    if (data.categories.others.list)
    {
        for(const cat of data.categories.others.list)
        {
            types       = types + " type-" + cat;
            categories  = categories + "," + cat;
            if (cat2display.includes(cat) && parenthide  === 0)
            {
                display = 1;
            }
        }
        subcat      = "&nbsp;&nbsp;|&nbsp;&nbsp;" + data.categories.others.translations.fr[0];
    }
    if (display === 1)
    {
        if(data.media)
        {
            for(const image of data.media)
            {
                if(image.type === "photo" || image.type === "poster")
                {
                    var link        = image.link;
                    var imageurl    = link.replace('https://agendabrussels.imgix.net/','/wp-content/themes/BX1-2017/cache/img/agenda/');
                    //console.log(imageurl);
                    break;
                }
            }
        }


        var datelist    = '';
        var today       = new Date();
        for(const date of data.dates)
        {
            eventdate = new Date(date.day);

                var nexteventdate = new Date(date.day);
                let dd = nexteventdate.getDate();
                let mm = nexteventdate.getMonth()+1;
                const yy = nexteventdate.getFullYear();
                if(dd<10){
                    dd=`0${dd}`;
                }
                if(mm<10){
                    mm=`0${mm}`;
                }
                var createdate = dd + "-" + mm + "-" + yy;
                var datelist = datelist + createdate + ",";
        }
        var lastdate = formatDate(data.date_end);
        var nextdate = formatDate(data.date_next);
        if (typeof subcat !== 'undefined') {
            var generatecat = data.categories.main.translations.fr + subcat;
        }
        else {
            var generatecat = data.categories.main.translations.fr;
        }
        var bloc = `   <div class='calitem ` + types + `' data-city='` + data.place.translations.fr.address_zip + `' data-date='{` + datelist + `}' data-categories='{` + categories + `}' data-item-id='` + data.id + `'>
                        <div class='item-image'><a href="/agenda-brussels-details?ID=` + data.id + `">
                        <img id='item` + data.id + `' src='` + imageurl + `'></a>
                        <span class='item-category'>` + generatecat + `</span></div>
                        <div>
                            <H4>` + data.translations.fr.name + `</H4>
                            <span class='item-location'><i class='fa fa-map-marker-alt'></i>&nbsp;` + data.place.translations.fr.name + `</span>
                            <span class='item-date'><i class='fa fa-arrow-right'></i>&nbsp;` + nextdate + `&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class='far fa-dot-circle'></i>&nbsp;` + lastdate + `</span>
                            <span class='item-button' onclick="gotoURL('` + data.id + `');">Afficher l'événement &rang;</span>
                        </div>
                        </div>`;
        jQuery(".results-agenda").append(bloc);
        if (imageurl == undefined)
        {
            //console.log(data.categories.main.id);
            //var randomimg = getimage(data.categories.main.id);
            jQuery.getJSON("/wp-content/themes/BX1-2017/assets/js/categories.json",function (globaldata) {
                jQuery.each(globaldata.category,function(key, val){
                    if (val.id === data.categories.main.id){
                        picturelist = val.images
                        if (picturelist !== undefined)
                        {
                            imageurl = "/wp-content/themes/BX1-2017/img/nopics/" + picturelist[ Math.floor(Math.random() * picturelist.length) ]['file'];
                            //console.log("Catégorie : " + id + " || Image choisie " + picturelist[ Math.floor(Math.random() * picturelist.length) ]['file']);
                        }
                        else
                        {
                            imageurl = "/wp-content/themes/BX1-2017/img/nopicture.jpg";
                        }
                    }
                })
                SetImageUrl(data.id,imageurl);
            });

        }
    }
    //console.log(data.id + " : " + types);

}
function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;
    switch (month)
        {
            case "01":
                monthletter = "Jan.";
                break;
            case "02":
                monthletter = "Fév.";
                break;
            case "03":
                monthletter = "Mars";
                break;
            case "04":
                monthletter = "Avr.";
                break;
            case "05":
                monthletter = "Mai";
                break;
            case "06":
                monthletter = "Juin";
                break;
            case "07":
                monthletter = "Juil.";
                break;
            case "08":
                monthletter = "Août";
                break;
            case "09":
                monthletter = "Sept.";
                break;
            case "10":
                monthletter = "Oct.";
                break;
            case "11":
                monthletter = "Nov.";
                break;
            case "12":
                monthletter = "Déc.";
                break;
        }
    return [day, monthletter, year].join(' / ');
}
function clearzip(e) {
    var regex = new RegExp('\\b\\w*' + e + '\\w*\\b');
    jQuery('.calitem').hide().filter(function () {
        return regex.test(jQuery(this).data('city'))
    }).show();
}
function filterzip(e) {
    var regex = new RegExp('\\b\\w*' + e + '\\w*\\b');
    jQuery('.calitem').hide().filter(function () {
        return regex.test(jQuery(this).data('city'))
    }).show();
}
function clearcat(e) {
    var regex = new RegExp('\\b\\w*' + e + '\\w*\\b');
    jQuery('.calitem').hide().filter(function () {
        return regex.test(jQuery(this).data('categories'))
    }).show();
}
function filtercat(catid,itemid){
    jQuery('div.calitem').each(function(e){
        var category = jQuery(this).data("categories");
        var category = category.replace('{','');
        var category = category.replace('}','');
        var itemid   = jQuery(this).data("item-id");
        var catexp   = category.split(",");
        var showitem = 0;
        catexp.forEach(function(entry) {
            //console.log("Controle : CAT : " + catid + " Block : " + entry + " // ITEM ID : " + itemid);
            if(entry === catid)
            {
                //console.log("Touché " + jQuery(".calitem[data-item-id="+itemid+"]").data("categories"));
                showitem = 1;
            }
        });
        if (showitem === 1)
        {
            jQuery(".calitem[data-item-id="+itemid+"]").show();
        }
        else
        {
            jQuery(".calitem[data-item-id="+itemid+"]").hide();
        }
    })
}
function cleardate(){
    jQuery("#datepicker").val(today);
}
function filterdate(date){
    //console.log("Selected Date : " + date);
    jQuery('div.calitem').each(function(e){
        var dateval1     = jQuery(this).data("date");
        //console.log(jQuery(this).data("date"));
        var dateval2     = dateval1.replace('{','');
        var dateval3     = dateval2.replace(',}','');
        var dateval      = dateval3.replace(',""','');
        var itemid       = jQuery(this).data("item-id");
        var dateexp      = dateval.split(",");
        //console.log(dateexp);
        var showitem = 0;
        dateexp.forEach(function(entry) {
            //console.log("Controle : CAT : " + jQuery(".calitem[data-item-id="+itemid+"]").data("categories") + " Block : " + entry + " // ITEM ID : " + itemid);
            if(entry === date)
            {
                //console.log("Show");
                //console.log("Touché " + jQuery(".calitem[data-item-id="+itemid+"]").data("categories"));
                showitem = 1;
            }
        });
        if (showitem === 1)
        {
            jQuery(".calitem[data-item-id="+itemid+"]").show();
        }
        else
        {
            jQuery(".calitem[data-item-id="+itemid+"]").hide();
        }
    })
}
function filterdates(start,end){
    jQuery('div.calitem').each(function(e){
        var dateval = jQuery(this).data("date");
        var dateval = dateval.replace('{','');
        var dateval = dateval.replace('}','');
        var itemid   = jQuery(this).data("item-id");
        var dateexp   = dateval.split(",");
        var showitem = 0;
        dateexp.forEach(function(entry) {
            //console.log("Controle : CAT : " + catid + " Block : " + entry + " // ITEM ID : " + itemid);
            if(entry > start && entry < end)
            {
                //console.log("Touché " + jQuery(".calitem[data-item-id="+itemid+"]").data("categories"));
                showitem = 1;
            }
        });
        if (showitem === 1)
        {
            jQuery(".calitem[data-item-id="+itemid+"]").show();
        }
        else
        {
            jQuery(".calitem[data-item-id="+itemid+"]").hide();
        }
    })
}
function SetImageUrl(id,url)
{
    jQuery("#item" + id).attr("src", url);
}
function gotoURL(itemid){
    document.location.href = '/agenda-brussels-details?ID=' + itemid;
    //document.location.href = '/agendaculture/detail/' + itemid;
}
jQuery(document).ready(function(){
    jQuery.getJSON("/wp-content/themes/BX1-2017/cache/cache.calendar.cur.json",function (data) {
            jQuery.each(data.data,function(key, val){
                makeBloc(val);
            })
        }
    );
    filterdate(today);
});