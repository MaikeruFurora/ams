const Config = {

    /**
     * 
     * @param {*} buttons
     * 
     * 
     *  
     */
    dropdown: function(buttons){
        // {name:null,text:null,value:null,icon:null,color:null,id:null}
        let btnHTML=`
        <div class="btn-group btn-group-sm" role="group text-center">
            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-expanded="false" style="font-size:11px;background:#84bdd9;color:white">Option</button>
             <div class="dropdown-menu" style="font-size:11px">`
                buttons.forEach(val => {
                        val.elementType=='button' || !val.hasOwnProperty('elementType')?
                        btnHTML+=`<button 
                                        ${ ((val.disabled)?'disabled':'') }      
                                        name="${val.name}"
                                        type="button"
                                        value="${val.value}"
                                        class="dropdown-item border  ${val.hasOwnProperty('color')?val.color:'primary'}" id="${val.id}">
                                        ${val.icon} ${val.text}
                                    </button>`
                        :
                        btnHTML+=`<a class="dropdown-item border" href="${ (val.hasOwnProperty('disabled'))?((val.disabled)?'':val.url):val.url }">${val.icon} ${val.text}</a>`
                });
        btnHTML+=`</div>
        </div>`

        return btnHTML;
        
    },

    selectData: (src) =>  {
        return {
             placeholder: 'Select an item',
             ajax: {
                 url: src,
                 dataType: 'json',
                 delay: 250,
                 processResults: function (data) {
                     return {
                         results:  $.map(data, function (item) {
                             return {
                                 text: item.name,
                                 id: item.id
                             }
                         })
                     };
                 },
                 cache: true
             }
        }
     },

    loadToPrint:(url) =>{
        $("<iframe>")             // create a new iframe element
            .hide()               // make it invisible
            .attr("src", url)     // point the iframe to the page you want to print
            .appendTo("body");    // add iframe to the DOM to cause it to load the page
    },

    datePick:(disabled=false)=>{
        if (disabled) {
            $(".datepicker").datepicker({
                format: 'mm-dd-yyyy',
                autoclose:true,
                endDate: "today",
                maxDate: Config.today
            })
        }else{
            $(".datepicker").datepicker({
                format: 'mm-dd-yyyy',
                autoclose:true,
            })
        }
    },

    date:      new Date(),

    tableData:    $("table[id=datatable]"),

    FormSupplier: $("#FormSupplier"),

    FormStatus:   $("#FormStatus"),

    token:        $("meta[name=_token]").attr('content'),  

}
$('input').on('click',function(){
    $(this).select();
})

$('.amount').number( true, 4 );

$('textarea').on('click',function(){
    $(this).select();
})


