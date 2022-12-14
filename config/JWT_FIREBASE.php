<?php
// include_once './vendor/autoload.php';

// use Firebase\JWT\JWT;
// use Firebase\JWT\Key;

class JWT_FIREBASE {
    CONSt KEY = "8ebdc88c5685c95670944766235478ddbe0bba332445245385c90553acd89a8a23035fb9b6825180759c8f8a7762458822e8574d87bbf72b964e566cb6d4fa2753bf65770c897df2c939918125c6989ff33383892e7740ff87399a1e54a13ad9ccc65fbc629a5ef680c3ad525dbf9ae1408f2f249aa4ad2d08257d561fdf968550339c446d8d67770d250a13cc4eb1dc0c07098bbd29a65ec0320e3c8d50470a6ec0c3d953a198b000d5800c3dbbab19abc2453abf35d1563e587fa0b69f8ae16784a210ed3caeabbd8f2d3edb35d3cec130551909b88ba015a18e228523ec96189f9ed7d31feefd155bdfb44b71c8c0ed0494c33352841813c0c1870432b07b280cd978f95dabc4dddd32f1f8b70af9afe80e05a0b7edb541b62fe7b4942bbcf1216de3bcb4f8eb7423517fdfdc59c599f5086909c318daff26c7f895dc7c1e";

    public static function createToken($id){
        $payload = [
            'user_id' => $id
        ];

        $jwt = JWT::encode($payload, self::KEY, 'HS256');

        return $jwt;
    }
}