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
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false" style="font-size:11px">Option</button>
             <div class="dropdown-menu" style="font-size:11px">`
                buttons.forEach(val => {
                        val.elementType=='button' || !val.hasOwnProperty('elementType')?
                        btnHTML+=`<button
                                        name="${val.name}"
                                        type="button"
                                        value="${val.value}"
                                        class="dropdown-item border  ${val.hasOwnProperty('color')?val.color:'primary'}" id="${val.id}">
                                        ${val.icon} ${val.text}
                                    </button>`
                        :
                        btnHTML+=`<a class="dropdown-item border" href="${val.url}">${val.icon} ${val.text}</a>`
                });
        btnHTML+=`</div>
        </div>`

        return btnHTML;
        
    },

    tableData:    $("table[id=datatable]"),

    FormSupplier: $("#FormSupplier"),

    FormStatus:   $("#FormStatus")

}