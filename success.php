<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Success</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h1 {
            color: #28a745;
        }
        p {
            font-size: 18px;
        }
        .btn {
            background-color: #28a745;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
        .btn:hover {
            background-color: #218838;
        }
        .success-icon {
            width: 80px;
            height: 80px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Success icon added here -->
        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAJQAAACUCAMAAABC4vDmAAAAb1BMVEX///8BpgEApgAAowAAoQAAnwAAnQD8/vz3/PfY7NgAmwDx+fHg8eBXuFfQ6dBLskuKzIrs9+zG5Mau2a5BrkF5w3mVz5VlvmW43big1aBeul4/sT+/4r9rumsqqio3rjcepx6n1qd1xHVswGyBxoEtN28sAAAKL0lEQVR4nM1ciZKrKhAVGrdo3KLZx5jl/7/xuWRpEFAiufV66t6aygRtDk3v4DhLKIqTYrO97dK6IZQSUqe7arspkjha9NgFDJ2zv7QGxhgAdCzR9l/7a/dBnf5l+3/NWLh/0JXb8kJaeMbUfgjgrki1D/1/xFF+ONasxUb4GX3Q4sbq4zb+PUfxply1HM0mYKty81u+wrsMIyVSL7wu9/BXHOWbywrkQqSnlq/VaZP/gKXgcALQQaJEaoDLe1hnKbo27jcgvbACtrHNkn8ugUxBokGKQl3Y5ik5egtQapliqW2B8jMAPSSdHn+TBDFW2VbuyYlRBUyD4nZdcjrebtXjUVV/6xN1PXcwOy9imWWWgoyAXHg6O9eU62wf5lHgt9Ri6vtBEOXhPlufmhdmwM6WeYrXrsK4Me+SbcJAOZlw86i9FjCoE8s8nQGoZDcR1qTbfNLUBnGWNicl319SJtPflHjNYfbsE8siHt2ZROsASwvbk59PQclGMFFwb7ZFxITCcrTrKDQ3m0owCCWkW4W4Fn2mVpZSqyglu85z5ml10zCV1KJmpnCxq2/O7mhnU7hrBoxxIl5m13xt2Fj7QarBKaxBMHFQWpbvrUtHRhROmgFBKeBE3aNlK5+NdzYhjcaVj1Jx7djVLktOJTNeOp6cl858Lx2x7aBVwhuGxdPtIwHZdtdZXjr/Lls7ttcMKd468+mglbYdtBvj39ArA7bVjIh5eaKwsxx3BzsJTlTrBwbrj0br5Wlt2/hiK/9Rmn+6qWfctqBsZ5snKU76qSeE4nlAaTtnUnHe0AunWqcM/BMnUXCxLeOVbN8R0CYatvw8wHawlgle43N/aw19wniBsq0zpbaFulpz4R+5mFP/5S/oMPKu+/190w46e9xCHy3ztAEZThM6Jyq5WZSWBapgknC/3Xh6nXPFM6Ery/5T0ki2XesZ6F8TAGeKLGe4clneo5VbnRV2OjHEM7DsGUQXaep2KvORn7gZ2I0R/Iss+qesmjAY3N6A1C5PD7kib6YM6wXpKAp2pTxjMpxIM5XGTlZ4Crroy5zOngwnupoQ8tajwDG6Z7VAcJYWAyjoXM2e4vpnQOWNdONBOukVbdCq0wmFZkZ9vDZGalrIHQdHena33l0SnXfmZVrn5FjMXZsey1aaMtV5INVLoLFTQRqLLnDCcHzwMWJqqS28w/O3I1o9dlAOMKZcXhcEdSgZu3AcQAlr8hMxD46DdRmZYeUrojZIeEYReyyMFsX8IRcoUNezju1yP+P3B1Jv2vDZjPYvK8zjpFGDh04zQdX/judjT5uHCoG6KDXUfkCWdr9HK7T3JtzT+eSnQqbkZV6UGidshq+sum1wdtE8rBWcHrI4oRVy5eZ+5w97dzQDNA9bRdWzJI/Rp3+VWvCd+eiB+UOLP+njzKRcHieQRulmX9+OIPx1JhOteamuleUdxXEYJklSFMX5XKj9eH8HVIaUOkJPUASWRpzbAmvlex4rD5Pb0UPF1kGhodQx0hotV6s+EzQptZxH9bjaTqG5SkUkaTjV9H66pvbHCXbSh64vUsdhoTueefsEdy3TayepitK6/nv0fFZ09YiPVVLK+QPGM+9n34y9EHnGh4LO1Ifu5/ts42wxUkrZvUijpH7MQ7D5iVRDEX1aMMdIbZ3bx/IRovQpogqkSPWSxeEb1GKkMPwHWgMWkc9j4dYGMp/J6KrQV1B0TVEALIqZTPpabaD30wIkh7Bzys/EXg6WnOKXNROAaD9wP75FMY7Qe9lTK5uBqTVio3SajwTATesKRzt5k0KHQ/X6kjyVMWkqfGxX6o6pN4tTGYdtr3dHSHW6+jisvLjzBqToZKOSj2SWNg5BSFUTQ1u/XilYvcsaKnbetD9boQdT7OJpzMCL4ov8tV07UqBevOl01wOPdKjB8jl9GC7NodBOlq+u9E9qJ4pj6jOCX74ZMZ+0DDWs4Kn+dvHE5SNmSHW7V55v6mqoUgjZjKiNE3TiYM9F7RdyD5DHTiqaVSUQVEKKtJauLwBRt4IypKQ/UM96JFaeJ2xmiDr8ER4hL0dJJY3N8rAFM4MNMp1bSwtSuTWRaNV58ZFgkOe5LqOHrBX6SiCYmcSJeNcFO3ne/GBmrK/kymsy3ToQ5+RdeXfYIOyLFVEUD5S+cPYhwR3mAgeTkkwi1KVkqovNlQchcMAznvJ6eJJW8DDp3XKOcIjVxHwwatYAmUlq5/gH0tm7GRcbu1FIl5rm8Y4KR+b5NG/200K8XG3YjqMn0wRHflFEXsPDJt2zN23EiHi/IBVU6DS7tgeCpwxB3kfEi5JmB743htPl88v1AUoKDEkzB8/ONL3oj9rS3qBf5ifkc67Q339ULUnEfqrDokQZVFdx68hTEpelrK9ysTLqa0jRwGfKOl6W3D/KYlSjRpmkQWa0Huyvf8SMGpdBpEbQaBtzYL+i9C1XMDJOWm8k1Q6TLie/wRnIl1DHuLTmmZfWxtGeZ9K9k+C9t3pvfy71Zl6diUWmYG1Sn1vLS6DXheXaCrhOYCN1wIk51rhLC9sBL+tmbU43jDM2TVwLwHxP/U1dvI6E1aREkHvY2cGAcLL2DVRILjSJbxndMVB8h9TSthJUi6Guif3E3nhrL7m/LW7A+fSwmx29wgZddOf45rcvWpXeuU5Sm4jkmUsenYShBy6pa97U5T9lg4KJ3swv+K2jPNbi9rfkuYuM+hoeOFNCYGThOKto4PO/aZAOk3jWKXAXkwxjoaVSXN4Zb+ikan5U5Yg9d0TWQ8E3n7KdKVN9R632VIBIR647x5MNXdym2y6GoGj0dOViWUW5gy8/fdHQXBsdxSyE/mmFFGcLW7/3rkGnv9CPqlS5Ae+twcmwST4q5wMVie9STqeAZccJ5vPkn4DzwIhGBYkHL+blsM2p6xHAL3JNjqi8ilO2eTpyLWgU9K8RD/Mw24d5ep7Eg0/6Um7XK4qR+sWxJydIxSNok7L48wNi+YlPS85Ktf/4KF1CxLWY433/9tDhRmzbnWnCf3g8M7+LBTBQNyLxlPzqIGuSivlkqGeHY7858ptno7K4/myYQJLD0Wzp4ejiIlYJieFlCvEok7LwGHmyHl/BYoRTz1Vq88B9fgfJ40rjDsBe74pogVt90UoYVu64jDM0MhhzdZO0iLRorRMjc+gn62aMUqczv7P1W+l1ReDV1/nXXVxrWScKXdDmWigvBlkf8smJ9heDMCIpb1FQd+tOU3yUN0cSmHuFirxZ97iob3r+ZTPO57KZa5V+LpsZF22AZEtdx6R051zL09/Kc9ull/G1PPyY1kOzYLL8LeMlayxk3P1F4z9z0sS2dnzZ8O7N60KYIkrcnbXbzfxzCqqWyqmP0R8AyrNNlz/YLLo+bECp2diOjYJrueiiNSivvwjXos3J+/ZKOu/yu6sYv7y8r9799oYh02sOCVudrv/g+sX/34WQA82+OjP+V1dnPinaP/5fl4y+GfvNdaz/AcDPhNuZ6Yn3AAAAAElFTkSuQmCC" alt="Success Icon" class="success-icon">
        <h1>Transaction Successful!</h1>
        <p>Thank you for your payment.</p>
        <a href="index.php" class="btn">Go to Homepage</a>
    </div>
</body>
</html>
