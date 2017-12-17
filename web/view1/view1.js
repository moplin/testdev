'use strict';

angular.module('myApp.view1', ['ngRoute'])

  .config(['$routeProvider', function ($routeProvider) {
    $routeProvider.when('/view1', {
      templateUrl: 'view1/view1.html',
      controller: 'View1Ctrl as vm'
    });
  }])

  .controller('View1Ctrl', View1Ctrl)
  .factory('View1Srv', View1Srv);

function View1Ctrl(View1Srv, ) {
    console.log('View1Ctrl++++++++');

    var vm = this;
    vm.title = 'KISHKI';

    vm.kToken = '';

    vm.cardData = {
        name: 'P PALACIOS',
        number: '4067425319932431',
        cvc: '122',
        expiryMonth: '05',
        expiryYear: '18'
    };

    vm.rsp = {};

    vm.type = paymentForm.cardNumber.$ccEagerType;

    vm.enviar = function (data) {

        let dt = View1Srv.getToken(data)
            .then(function (data) {
              console.info(data.data);
                vm.kToken = data.data.token;

                let data1 = {
                    "token": data.data.token,
                    "subtotalIva": 1, //"number (required)"
                    "ice": 0,//"number (required)",
                    "iva": 0.12//"number (required)",
                };

                View1Srv.makePurchase(data1)
                    .then(function (rsp) {
                        console.info('rsp >>>> ',rsp);

                        vm.rsp = rsp;
                    })
                    .catch(function (err) {

                        console.log('err',err);

                        try {

                                console.error(`
                            !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
                            mensaje::${err.data.message}
                            código::${err.data.code}
                            !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
                            `);

                        } catch (e){
                            //error
                        }


                    });

            })
            .catch(function (error) {

                console.log('err',error);
                try {
                console.error(`
                !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
                mensaje::${error.data.message}
                código::${error.data.code}
                !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
                `);
                } catch (e){
                    //error
                }
            });

    };


}

function View1Srv($http) {
    console.log('View1Srv++++++++');
    var dataFactory = {};

    dataFactory.getToken = function (data) {
        var modelData = {
            "card": {
                "name": data.name, //"string (required)"
                "number": data.number, //"string (required)"
                "expiryMonth": data.expiryMonth, //"string (required)"
                "expiryYear": data.expiryYear, //"string (required)"
                "cvv": data.cvc //"string (required)"
            },
            "totalAmount": 1.12, //"number (required)"
            "currency": 'USD', //"USD"
            "isDeferred": false //"boolean (optional)"
            //"userId": 'US001', //"string (optional)"
            //"sessionId": '' //"string (optional)"
        };

        let url = "https://api-uat.kushkipagos.com/v1/tokens";
        let headers  = {
            headers: {'Public-Merchant-Id': '10000002775498790864151007349017'}
        };
        console.log('getToken',modelData);
      return $http.post(url, modelData, headers);
    };

    dataFactory.makePurchase = function (data) {
      let modelData = {
          "token": data.token,
          "amount": {
              "subtotalIva": data.subtotalIva, //"number (required)"
              "ice": data.ice,//"number (required)",
              "iva": data.iva
          }
      };

        let url = "http://localhost:5000/moplinblog/us-central1/v1/fm/checkout";
        let headers  = {
            headers: {'none': 'ok'},
        };
        console.log('getToken',data);
        return $http.post(url, data, headers);
    };
    return dataFactory;
}







/*

      let modelData = {
          "token": data.token,
          "amount": {
              "subtotalIva": data.subtotalIva, //"number (required)"
              //"subtotalIva0": data.subtotalIva0,//'"number (required)",
              "ice": data.ice,//"number (required)",
              "iva": data.iva,//"number (required)",
              "currency": 'USD',//"USD",
          },
          "antifraud": {
              "userEmail": data.antifraud.userEmail,//"string (optional)",
              "orderId": data.antifraud.orderId,//"string (optional)",
              // "billingAddress": {
              //     "name": '',//"string (optional)",
              //     "phone": '',//"string (optional)",
              //     "address1": '',//"string (optional)",
              //     "address2": '',//"string (optional)",
              //     "city": '',//"string (optional)",
              //     "region": '',//"string (optional)",
              //     "country": '',//"string (optional)",
              //     "zipcode": '',//"string (optional)"
              // },
              // "couponCode": '',//"string (optional)",
              // "firstTimeBuyer": '',//"boolean (optional)",
              // "promotions": {
              //     "promotionId": '',//"string (optional)",
              //     "status": '',//"string (optional)",
              //     "description": '',//"string (optional)",
              //     "discount": {
              //         "amount": '',//"number (optional)",
              //         "currency": '',//"string (optional)",
              //         "minimumPurchaseAmount": '',//"number (optional)"
              //     }
              // }
          }
      }

 */