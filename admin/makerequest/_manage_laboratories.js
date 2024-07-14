let globalLabItems = {};
let globalLabSelectedItem = [];

 $(function(){
    const pesoFormatter = new Intl.NumberFormat('en-PH', {
        style: 'currency',
        currency: 'PHP'
    });

    // const products = [
    //     'Product 1',
    //     'Product 2',
    //     'Product 3',
    //     'Product 4',
    //     'Product 5'
    // ];

    // const productList = $('#productList');
    // const selectedItems = $('#selectedItems');

    // function renderProducts(filter = '') {
    //     productList.empty();
    //     const filteredProducts = products.filter(product => product.toLowerCase().includes(filter.toLowerCase()));
    //     filteredProducts.forEach(product => {
    //         const listItem = $('<li>').addClass('list-group-item').text(product).click(function() {
    //             if (!selectedItems.find(`li:contains(${product})`).length) {
    //                 selectedItems.append($('<li>').addClass('list-group-item').text(product));
    //             }
    //         });
    //         productList.append(listItem);
    //     });
    // }

    $('#search').on('input', function() {
        const filter = $(this).val();
        getAllLaboratoriesItems($,filter,pesoFormatter); 
    });

    // renderProducts();

    getAllLaboratoriesItems($,'',pesoFormatter); 

    $(document).on('click','.btn-add-selected-lab-product', function(){
        let selectedId =  $(this).attr('data-labid');
        
        if( !productLabExists(selectedId) ){
            globalLabSelectedItem.push(globalLabItems[selectedId]);
        }
        displaySelectedLab($); 
    });

    $(document).on('click','.btn-cancel-selected-lab-product', function(){
        let selectedId =  $(this).attr('data-labid');
        
        if(productLabExists(selectedId) ){
            removeProductLab(selectedId);  
        }
        displaySelectedLab($); 
    });
    
    

}); 

function getAllLaboratoriesItems($,keySearch,pesoFormatter){
    let action      = 'GETALLLABORATORIES';

    let ajaxParamData = {
        action,
        keySearch 
    }; 
    $('#productTable').html(''); 
    $.ajax({ 
        type: "POST",
        url: '../_controller/makerequest_controller.php',
        data: ajaxParamData,
        success: function(response)
        {
           var jsonData = JSON.parse(response);
           
           var res  =jsonData.result;

           let htmlTableLab = '';

           for (const row_index in res) {
                let row = res[row_index]; 
                globalLabItems[row.Id] = res[row_index]; 
                htmlTableLab += '<tr>' ; 
                htmlTableLab += '<td>'+row.Name+'</td>' ; 
                htmlTableLab += '<td >'+pesoFormatter.format(row.listprice)+'</td>' ; 
                htmlTableLab += '<td >  <button class="btn btn-sm btn-outline-secondary btn-add-selected-lab-product" data-labid="'+row.Id+'">  Add </button>   </td>' ; 
                htmlTableLab += '</tr>' ; 
           }
  
           $('#productTable').html(htmlTableLab); 
 
       }
   }); 

}

function displaySelectedLab($){
    const selectedItems = $('#selectedItems');

    selectedItems.empty();
    console.log('globalLabSelectedItem',globalLabSelectedItem);
    let htmlSelectedLabItems = '';
    for (const row_index in globalLabSelectedItem) {
        let row = globalLabSelectedItem[row_index]; 
        htmlSelectedLabItems += '<li class="list-group-item">'+ row.Name +'   <button  class="btn btn-sm btn-outline-secondary float-end btn-cancel-selected-lab-product" data-labid="'+row.Id+'"> remove </button> </li>';
    }
    selectedItems.html(htmlSelectedLabItems);
}

function productLabExists(id) {
    return globalLabSelectedItem.some(SelectedItem => SelectedItem.Id === id);
} 

function removeProductLab(id) {
    const index = globalLabSelectedItem.findIndex(SelectedItem => SelectedItem.Id === id);
    if (index !== -1) {
        globalLabSelectedItem.splice(index, 1); 
    }  
}