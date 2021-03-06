<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
$this->title = 'Регистрация';
?>


<div class="row">
<div class="site-login col-lg-6 col-md-7" style="margin:auto;float: none;">
    <div class="block-header">
<center>
    <svg width="42" height="50" style="" viewBox="0 0 42 50" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
<rect width="41.6667" height="50" fill="url(#pattern0)"/>
<defs>
<pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1" height="1">
<use xlink:href="#image0" transform="scale(0.0142857 0.0119048)"/>
</pattern>
<image id="image0" width="70" height="84" xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEYAAABUCAYAAAA/MEEUAAABS2lUWHRYTUw6Y29tLmFkb2JlLnhtcAAAAAAAPD94cGFja2V0IGJlZ2luPSLvu78iIGlkPSJXNU0wTXBDZWhpSHpyZVN6TlRjemtjOWQiPz4KPHg6eG1wbWV0YSB4bWxuczp4PSJhZG9iZTpuczptZXRhLyIgeDp4bXB0az0iQWRvYmUgWE1QIENvcmUgNS42LWMxNDIgNzkuMTYwOTI0LCAyMDE3LzA3LzEzLTAxOjA2OjM5ICAgICAgICAiPgogPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4KICA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIi8+CiA8L3JkZjpSREY+CjwveDp4bXBtZXRhPgo8P3hwYWNrZXQgZW5kPSJyIj8+nhxg7wAAEblJREFUeJztnHl0VFWexz+vtqRSlY1QKSAlCBgg7IQdEkVBgUFtQJlxBFpHW0TcQNql29Ge07a2x0EWF0DbbRCnW1zgtCDIICACAsq+hCVREiqQShGSVGpJanvzx6tXqapUkkpSBOiZ7zk5ee9u73d/dd9vu793BaLAYDT1A14Hbg4UfQv81moxn4jW/lqBwWjKQZrXeEABbAWeslrMxyPbClE6ZwM/ASkRVdXAMKvFXBh3itsBBqOpJ7AfSI2osgHDrRbz6dBCZeQAOn3KW8AwvV7P/KcWMHrMGI4cPoLb7U4EMpwO25eXi/jLCZ0+ZRkwQq/X88T8J8nLz5fnlQAYnA7bF6HtVVHGyAOY9evZ3HHnnQDYqm28+847wbprFGMA7p05k19NnQpAja2GFcuXA+RHNlZEGaAWoLKyMlhQVVUlX7riSmr7wgMR86oOzqs2snG0FbMBmP/Zp2uw19jxi36+2bgptO5axQagzxeff47dYUchKNj49ddy3frIxtGEbzqwC8iJqDoO5Fst5srIPtcCDEZTKrAT6B9RVQDkWS3mS6GFDV6lwMRHAe+EFK8ARl+rTAGwWszVSHJmeUjxO8CoSKZAlBUjw2A0DQYOBm6HWC3mQxH1ecAUoAeQECguBhZaLWZvoM19wLRGHrHLajH/Z8h4/wEMbnRmLUMd8DOwwWox74ygu8l5yYgmY5qEwWjqDnwE3Bit/u2VK7MHDhxQDjD1jjunVVRURNpDACiVyjtOFhX3A3A4HMpJt942q6W0xIDnDEbT98D9Vov555Z0bBFjAhbxDqADgLFTZ27I7k1GRjoajYqsrCwGDhwwWW7/wh9eZNfOXVHHGjR4kAK4D0Cn0/HCH17kZMHJlpDTACIibreXiopKCs+cwlJ2ASRV/KPBaLrJajEfi3WsmF8l4BRwFOip1SbxwJx5jBg1FqMhFV1SQmPDXBE4nHVYrNXs27OLD/6yHJfTCdKr1R/oTQyvUjQ7pjHMAXoqFAoWPPM8I0aNJVmvveqYAqBLSiBFr2XEqLE89cy/o1AoQJKFc2MdoyWMmQUwckwevfv0BSAtJakF3dsXqakSbb165zB6bFAczoy1f0sYMwhg2PBRACiVCtTqBq7WVQO1SolSKU0vd9hIuXgQTYiPUMTKmGRADdAhoyNA8KFXM2QaMwI0IykbfSx9Wzw7larFGv6KQ6lq+coOm6XBaFIC85DUaM+Qqo1touzqQuhcthuMpkJgFfC21WL2yRWRP//HwL9GGUwXf/quGELnkgoMDfyNJmTuQcYYjKZb5Yo+Of3Iy89Dq5VUcV1dHe+uDHWdrl08PHcumgQNAC5XHTt37uLkiWMA9xiMpg+tFvNmCF8xk0ASrr978SV6dDMGK+x2e4sYU1payupVqzh9+gzp6encfsftjLv55uY7xoDvtm/nq79/RWVlJb16ZTNz9mxMJlPM/adOn4ZeXy9/82+eyILH5nCp4iLARKABYzIAMjONaDTqVhNefPYsD895GIfdHizbu2cPcx5+mNn3/brV4wJ8vOpj3l25Mnh/+tQptm3bzop3VtK9e/dWjanRqMnMNMqMyZDL465zV65YicNuR6/Xc++smfTtJxmDH7z/PpcuNfDuY0ZlZSUfvPceAH379eXeWTPR6/U47PYwZsULcde9R48eAeA3Dz3EXTPuxmG3M3niJLxeLycLChgzdmyrxj1ZUIDX6wXg9SVL0Ov1ZBoyWbpkCUePHI0b/TLivmKSkiRT/OzZXwAoLi5BFEUAtNrWuxDyuNKYxWHPSExMbPW4jSHuK+aWW8bzyerVrFu7jt27d3OpQnp9Mo2Z9B8QGVWMHX379cNoNGKxWHjskXl0yOhAuaUcgPG3TogL7aGI+4r5twcfYNRoyZ8qt5Tj9XpJT0/nTy+/jFrdeqGuVqt56ZWXSU9Px+v1BpkyavQoHnjwwbjQHoq4r5iEhAReW7SIgwcPcubUadLS08jLy0Onj8lFaRI5OTn89dO/sXPnTqoqq8ju3YshQ4YgCDH5hS3CZXF8BEEgNzeX3NzcuI+t0+uZOGlS3MeNxNXvIl8h/D9jGkEoY5wAdnsNol+8LA+rrKzksXmPsnTJkqBN0hR8Ph9Llyzh0UceaZNx2BREv4i93kp3yhehMmY38Ij5XAmrV33AlCmT0Gol+8DpdBIPFJ4p5PChQxw+dIjTp06z4KkFZPfqFbXtmdOnWbJ4CUePSAZjUWERHUZ0aDMNPxcVoQ3YRC5XHRs2bMR8rliu/kG+CIpzg9GkAU4D3Zoa+KVXF9O1W3c0GhWmzi0jVBRF3li6jM8/+yxYljt0KCNHjqRT584AlF24wN69ezmwf3+wzd0zZvDE/CdbrH3MFy7hdnspKf6FF557qrnmF4DrrRazG8JXjB+Q/HEEIP6vkyAIPLlgPgMGDuTNZcu4ePEiB/bvD2NCKDIyMnj8yScZP2F83GkJoYrAXJWELJRQxtwOdAYwTVqCMjEtWCF6nJRsmBc3Um4Zfwv5N+azbetWvtv+HUWFhVy8eBGAjh070qNnT24adxO3jB/fJqMwGrpOWY6grncv/B4H5zY8KgKZwN3AJxDOmHkACR2yHYkde4dF7PxuR/11nASzWq3mtokTuW3ixLiM1xRkXw1ApctEoQkPSCYa+tprrSeSkfadPoGAVjIYTSZgAkBazrQGYUxBnYi8yqqrpYSHeDHockKm0VZdHSwTVA03CNNypiUHLvMMRlNXqFfXzwOCICh9+q4NwwKCoESdLAnHQBgQr9eHz+eP0xTiD5/Pj9crxbZPHJc0mzq5M4KiobGvyxqBoFTXBW7vhnrG9AfQpHd3CUpN1AfJDNu65Rs52kWN/erNPKuxS9ljly5VsG3LZgD010WPBQlKDUmdhsjyYjKAwmA0aYHhAKm972w0YJKWMw2FSkuty8WiV1+i3FJGVbUTt6d5Q6294fZ4qap2YC23sOjPf8TlcqJQaUnLmd5oH13XsbK2yTMYTRoVUiZDAkBSp0GNugjKxHSMY5/mwo6XKDWX8Punn2DUmHyye/eh63Vd0Fwl27Vuj4+Sc+c5c+oke3Z/j8fjAUEgc8xClNr0RvsldRmmQFC4Ef21gCAYjKYFwGKFSlvT454vkxvtGYDDvJfy3a/jc9fEcTqXD0pNMpljFqIzjWy2rbvq7Ksl6x9ZbLWYrSqgL4A6xVSDtEfdJHSmkXSb+iHVZ77GUboXT815RK87RjL9+D2SXNJqtXJ6RuOt/X5cLqm9Qq0lVp9XUGlQJ3dBlzWS1Ox/aqCeG4Mm7fosq8VsBcmOyQZISO8es6et0OhI7zeD9H4zYu0CgMduoXjd/QCsfH81CE0/UhR93H/v3QBcN2UFar2xyfZxQG/5QgV0AVAnd27XDCCfx07Pnj2bbFNUVNRO1ATRSb5QIZnCqHSZ7ZwaJaJQNOcUtq8RKfq9qQajaTFQoCLwNYZCnRT/PYhrDK6yw8nAAsAbfMkV6qT/89E8QamWedB8FpCjdC+2M5tw284h+jxte7IYTD/h6YULUaua9pw93vrnlW5eCELbbCVBqUaTYiIlezK6rKbVtwopDqPwux111Gd4A1Bx8EMqj69pEzGNoeJiRYvae50ta98YPLZSHOa9pPebQcaQB8Lq/B6nzAO/CqgEMny1VXZCGOO8cCDIlM5dshicO5yEBKlarVKi1yXGmOZ3BSGC3VGLJ+BMut11HNz/IxfOl1J5/DO0nQaT1Ll+i8frrJB5UKECrECGp+a8jZA0CFuR5HgZMo388ZXX0STULyZTlw5o1NdGLp7b48V8vj6QPu2ue3j+2fmUW8qwFX4TwZiL1Ug8qFAgfRhBXXVxmKvsqTkPwICBg8OYIgjCNcMUAI1aFRYr1iQk0H/AIAA89gvhbVOyCgAvsEWBlAqPu6o43LP2S8tPFRFavAy7oZcdkTQH5+T3hZUn95iwDUiyWsyPKwjk1XudFzsjXr2Bp3bCAavF7AHJKzsAgOhPcFeX1DXV6x8ctYTsKymAE0ANgL1kV3Ejnf7hIfrcewtXTw4m8ikCX6NtBqj5ZesVI+xKo3TzM3rghMFomgP12ycbgLs8NRd6+D0Ov0Ktaxf34ITZxyV7vVwzdVBwfWb7RwL9Hoe/tuJ0WLpXKGO8IKpsZzadSOt7V994PXTxeheFZZL0Vwjwq+Eabh2owV4r8vmeOn4pr9cMKiUs/00ycpT0y711bDla7xYoFbBgipYexvgyz1a4uQDEfkiqeh0EQmJWi7kc+Aqg8viauH6E1CdLicst4nKLOOpE1u5z46wT0ScKzJ+iDWvr9YHHK4UaHHUim494gn1dbpE6j4gxLf6LufL4Gnlr5H8CvAiLFb4H4KuzXe+yHLXE66Hj+qpJVNcbEi63yLbj0ipI0TY0iuSvfTYedFPnCY/HTB2RgC4hvoZUbfnxMl9tVXbgdoVcHsqYTUARgHXvG3FjTFKCwKQh4XtV6/e7qXSIUcNQGrVAWZWfbw6Hx5FzspRMHhx9z6stKN+zrDxwWUTISQRBxlgtZj/wJwC3zTzQ73G0McZQj0mD1KQk1f/StR6Rd7e4KKtsaFBeqPTz1iYX3hCjVJ8oMGeCNu5Wt9/j9Lht5wYGbl8J8ABoGHZfTWDVeBxWH3FCglpg2ojwyOnJUh8vrnE0aPvCpw5KL4Uz7P5xiaTp4u+LeBxByV+E9M1SEGGMCdg0TwMg+uMa6rwpR01253Bt4o3Cen8Ur+Sy+az1c/ytfLqAjGhnO6wloKEA6mobnCDSKggCPDQ+Ea2m5b/825tcFJTGbQFTWxsWSPjaajGvi2zTmO57HHAAHD1yCH+0n7EVMKQomHtbIk19Z9q/qwpDSngDtxfe3OjibBzebr/fz9HD8vfo2AjkBUUiqqXkdNiqdfqUEmC6y+XE5/PRr78kowRBIC219V8CGlMl6/ZIsQ9PlHk+NlHLhIEaDv7ixVFXr7e8PjhW4uPGvmpUypatuiqbEzl36G+ffMSxI8GP8x+IPBRDRqMmpNNhO6LTp1wH5J4+VUBmppGu3bq3mTEgMSe/jxpRhEt2P7UB/afVCPzzmASSNAK5PVQcLfFhr61njsstMqCrio7JLTPyZMbs2P4tn/31Y7n4favF/HJjfZpkfSBF5FtgtFKp5PEFzzB0+Eiuv87QIsKag6NOsmx1CUKYDBJFsNrqGZeohszUllu+Z89Z2bfnB95a+pqcdrYLuEXO0IyGJp0Op8Pm1elT1gF3iqLY8ad9e+ja7XpycqLn5rYWGpVAUoKAOuIVEQTQJQqkJkl/usTWqewtW77l7WWLZFlZAEyyWsxNpms06405HTaXTp+yHpjm9/vTfty7m06dO3FDdnZzXa8KrP/7Vyxe9JrMlCJgvNViLmuuX0xuakAYfw5MFkXR8P2OHbjr3OQOHXpZPomJB3w+H2+98aZ8TB1IAbkJVovZHEv/mP13p8Nm0+lT1gA3AVlHjxzh0MFD5OYOQZ/cbFpNu6KsrIzfP/scW7cGA2+7gYmxrBQZLQpsOB02p06fsgopQ2JYWVkZG9avJy0tjV69el3x1SOKIhvWb+B3zz6LuX5h/AX4l+ZkSiRaPZPAwVxvEDiTs3///sx9dB6DBg1q7ZBtwrFjx3hj6TIKTgTPSa0G5lkt5v9uzXht+okNRlMW0pFpU+SysXljmTV7Nv0HDGjL0DGj4MQJ/uujjyLPwvoamGu1mM+1dty4rH2D0TQV+DPQRy7r1bs30++azrhx4+LyPWQoHHY7O77bwdq1a0NXCEAh0jG0XzXSNWbETSgYjCYV0vEqzwBBQ0etVjMkN5f8/HwGDxlC125dm01KjIaSkhL2//QTe37Yw4/79klpqvUoBF4GVkd6ya1F3KWlwWgSkA6PeDzwP0zAazQaTCYTHQ0GUlNTSElJRasNj/3aHXYcdjs2Ww3W8nLOXzhPrauBl+8FvkEKR24MDTLFA5dVjRiMpg5IJydORzpQsK3vVA3SOXzrgS/k1NPLgXbTr4HTjAYiHWCTg3T82g1ARyAJkINGPqRwgAUoQbJWDyPtsR+I16vSHP4XaZhLaULuwEEAAAAASUVORK5CYII="/>
</defs>
</svg>

</center>



     <div class="clearfix"></div>
</div>
    <hr ><center>
    <div class="alert alert-success">
        Вы успешно зарегистрировались в сервисе. Теперь можите перейти в личный кабинет.
    </div>
    <a href="<?=Url::to("/")?>">В аккаунт</a></center>
 <div class="col-lg-offset-1" style="color:#999;">
      </div>
    
</div>
</div>


