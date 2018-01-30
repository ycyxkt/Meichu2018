@extends('layouts.layout')

@section('title','賽事戰況')

@section('content')
<section class="gameboard">
    <div class="gameboard-background" style="background-image:url({{ asset('images/cover.png') }});"></div>
    <div class="container">
        <div class="gameboard-title">
            <div class="game-name">正式賽點數</div>
        </div>
        <div class="gameboard-content">
            <div class="team">
                <div class="team-logo">
                    <img src="data:image/png;base64,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">
                </div>
                <div>
                    交大
                </div>
            </div>

            <div class="score">{{$score_nctu}}</div>

            <div class="status">
                <div class="status-title">
                    @if($status=='交大勝')
                        <span class="nctu">{{ $status }}</span>
                    @elseif($status=='清大勝')
                        <span class="nthu">{{ $status }}</span>
                    @elseif($status=='平手')
                        <span class="draw">{{ $status }}</span>
                    @elseif($status=='因故停賽')
                        <span class="stop">{{ $status }}</span>
                    @else
                        <span>{{ $status }}</span>
                    @endif
                </div>
                @if($score_draw!=0)
                    <div class="status-draw">平手 : {{ $score_draw }}</div>
                @endif
            </div>

            <div class="score">{{ $score_nthu }}</div>

            <div class="team">
                <div class="team-logo">
                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAYAAABw4pVUAAAACXBIWXMAABJ0AAASdAHeZh94AAAgAElEQVR4Ae2dB5wURfb4q7p7ZgMLuwsLCigZdkHkPDPoiSgqGM+AeuacJYqihNlBlCRB8MwKBkzomc4sIgYMZzoD7C5LUgQVWHZh48x01//7ZmmcHXcJip7/z4/6fJaerq6uqn7v1ctVKLWr7ILALgjsgsAuCOyCwC4I7ILALgjsgoAKdbktJxkMozpP+cvILpPbJ9fX1za5zZ/t3vqzTcifT6hlKN3/7V9DuTNbact+N9R2WpZfJ1fHtkYFtRNKrLspb2pLy7bfv6HDhMzEevk9bLfJjZLr/iz3f1qEqCaZo0Jdpg1OBJSlY5cYpcNWmp7h14fzpp9sjJ5nlFoS6jrtMKkfoAbYQaVneJ4anxYMnuO3lWs4b9qYxlmBKxLr/ky//xQIubnr5LbJQGFi7bSl0vJzp10uzwTISunu4YLBTxhlXgnlTRt6badrU/h9/qLCVveVVXhTtdFDQipk7ZV3SL7xvAfChUNmK2Md4fcN8kZ4Rv+ktNnHr/Ov9c3Bf/ZHXv8UCHGN83R+3rQb+HAtHz8BNmMsvSG/YMh4apqG8qZe1r1Lz+M9Zf4tz6l/nEu7HKfDA1rpf85Vp7vTVg2rMsp9UudmzjKUcNGwV6Ut778X6jL9UPq/0RivIlw4+G5Nw8vUZQF5LIgO500d5yrnPrn/X5c/A0JAgv7aeGY5FPyQ8PwqJ6WP9vTbAhxBilbWniAopKqynvIBVhKzhgPsZaGCwW/4deGCYU8orVctKlwY9utMufuQZZn7YGlV+YVDZ0q9Meqj3TrnHXxjp9ubd8875HHl6ff5W+O/83/qCqVOHNlpUkf/o0X4wpbGy/3YztO6gpTnuX8xWUMa3XnaQf47O3oNdZ5yYOI7obzbujAPWZXP3dz1jji75Pc9t3e6PcVvN6rj1L3y86aH/Ps/6hpnEX/UYDJOuOv0Z5RRa5Xy1qVvcMdXZjs9oNge+YVD7pHnoeahDNUsa2i4YMhYuf+9SrjrtLFZUeuWQcWDamSMUO7Um5T2nlZV9k861YzWWttGq93yFw/5x+81h/r6deqr/D3rAP7G/ILBVwjFVzR1HoGflxttHvXHDK8Nl4Ou3xUZMlZo8ZAx/pi1V7PCUvb1Kk038Tw9Lr9w8JeskFl12/z+d78rQkQl9VxvU3jJ0DeTP+XmJUM+ou7UUO6081XUKkh+vqP3obah1PDKcPWOvue3d2P6v5ajo6HCwXP9usSraG8qr/GxyJrYFoUhscFO+v27IoQ5tla26pafO/VKra35XmzDw0nzNnHVNKmyvlvsh56eaxpZtrU/2lYXrYxG2DeCrVRpYzphn3zCOHsg1Flw8VX3nTZWwFjeN/mLh8oKRK43XMYtHfoNT+WvTgntMaWp1UhfxMs9eVCqLP0L4qrzwm+8+X0R4pml2tZr0ZSeDHWZeoQOZM9ExWm9vXPmndOxRY5BC2sPQN5Qtv6e65EB17sgauvdEIAjyja5VzRpZMHnTYYqKRupc7IeTt8Qu7oiO3CdZ7yvtKcCIHMRxuPHyIhi15j3olWRLyZ8e+OGbc/DdLcyrEmesR4MFw66LZQ3/SrlWku3/d6vb/G7IsSz3KXKc06T6YWLhr7F5a36XBmJ04eFtUOdHWMp7UDqnTeVxPpmZNldtaVvUtHY8zUq+Iqy7buV6w33tBrXJMO6RxWUXoT9MdE0a9LdxNTYimwn3xRsuFHnZT1hCkpPV3lZhwYiKj+aYl3haHOck552OVrVPO2qL0O1rDNxClt+V0Vq+k5cNqLMr9DG61htVz7p3/8e152qZWE9Pwi7qICFvFmuo2+l25U1ys2+A2Pssm1NHnlzFFb3ebTbG2q/L79g6J3hztMONJa5HhtlYsZG7xs0spn0/47rqS8sRz0J15rJO315J4aB+Am/L+Hdm2FlF8Cg7vCYCNpStonqD0DvgNRI9fTqYMoEU1Y6TGdmvcjHvwSra8uquw8PwNfbmiMs8SFsmfNHtBmfnZKWcqSlVV+jrar8xYOHbOvd7X2+c1cIhho8/R1YTMsMkzLZeMHGAChna5MJd5l6CEbfOQClt3HN8WpJ2QrdNWsACIIS3X9u2uCd1zjbmV+ZbYvgT/WUl6ltdRJs5FR8VWmWMS+r0rKfYllZe9qB0qmel93bMh5Go3UwAN8bFpmhHbUH8xhQpey76COlpFGJ20xlFXllpXdbTbKn8+xsNKrd0f4u4jlTaaBo3TGcO/0xEL+B75znGfWyZVSrBlr/quqdu0LEALOtXtgQfGRtCXWY3ia8bPC3/r1/FW8uwOgPezrJq9pwmQpkdLAc5yIEdoblqUc8AKct61ZWxJcg+MVQ4aAX/Xd39BpngybaROvgMODdko/+t6f0Oih8rQcGqdvIWHsyl7NB4LusTlGJf4GY5G8BiTdHY5HZtxRfv9Pkys5FCKohfPshhPi5WwNaqMOENjolZTqf/AospaPyvDbIg7dUxHpdp5jj0JN6e8YsRIDODhcP2hh3pbs6a9ySIYu31q//bGzX6Z15fw73Fn/PfFOwcFK3Tt0ahYvDG6WNOCZR0Q4Q9up57m1aO8dZnnnZs/SxyK21UP2BXsybHl46rFjaN1TwKDyOQbtTDcffhBDYzUnGUvvDqZd6aFSWFV1qqeCt69xll88snllT34dArReAhAuhxNX4AJ+tjkVeQ3Bu5ONupX07ZVkv5y8e+CirYguF8uxyqPc8E9H/UEHvaBB2EIC4tL7+pU6CVQFt56MC96efDyD2xnzoQbC7i1XBxqfCKswCxE+WN02AeTyEkWbc0gssJ2tMdaxyYordCCQZFDQ9qSHZIuqwbmzdbKLWeMuJdYSFdgTJHWG78+uzu2S87SlCQb+6RI0uQii2tpS10rJVrqVSroG3pjUPtO9UX6dxNVaZTHh1b1NSeinAr0wLpjwAwF+AmMtNYenZ+YsHPZKIjFCnCXug++fRX08dNN8gsGX1rauvf78uYDmXgIy/cT8fZJxAf02ZJ3aJPSCal7mb3068xvydDe7nWXZWPkpCq+LiL0pQtTd5MesmbJ3HIKCBfvs610YmD2UjWznuFcbYHViLxSC9k7Kii+q028Gb37RCZKz8rtMez45aF/g+ofrGFytXd82eAiVm4cOCO0FLSm3EjYJPS+2XGk2/cMSyy7eol34f6P1nWso8xFJ5hbpDANA9Na6569Ylw7732yRfofoXWFspEEY32r+PFtSZcVeBmNaWq84d0wDbu6nzlNZBx77VipkJnq0GiiZmZWZNQE1byjyXslL+nTxW4r1EMa00NTVUMEQUg19dftMKkVGNq54scbwztjYDnZd5Lut/rYlEb0BgXiyTRlNZL1TFqjitPmTE+/Mii2CF/aHiv4PB1UZZfwva9hKA/jVy4GHiJJckj2u53mjY6LfM7HVW3UGwxj1BzP6M97G7pLQwub1/L0hGPb7Ws/VZcKvMYGp2Y1ZVmYl5qMdm7LY8vzpNX+i5arbf36+9/uYVIgGevfJ6PQnQTqtvEvl5U7ELdBpU+i0LowWAaoU86AqC7hkjEb3tKKG2k3bXacHimphuH7RglJZ9Ma9dTT/vJ3tjQ7kTUUNTTkQGtKfNcP7m8VcK2zqKsT+N6thFtywevpK6LUUCVAD/ILO+9GRxborQt4ywSV3kafctEIsK7TVzlffyzQXXfbrlxZ9/6Pzc6U/jkDz156pf92uHEQJPzYfH9oLf/sw2jGrieO7AUUmspFbbUbcaHZ3pRvUmmWLAsS/EQfd8qGjwPCh8HDJhb2TK32FrhGiV5wtc/3NCXaacg/9qtPH0h3zw+X69EMLunQ51Zm52n/v1/lUQg5r7gnG9q7RjjUCBGKeUvb+ySmaHF4Ujfjvk10yAgL2kX6rx3IWbzIp1opCE8iZ318q5Fjkxz7KsDUQbISZ9KatlSqhwaB0VXOI4rKyx9Fnu94tcam889S98dVvi/1uebeXHDiNErNS09LR7iNSdvpV+lbjXbVsNpQ3OOB3hg9JwMF5gGfdS195YqL2sIVB4JybQXXnqU3j+wVDwLFjaPxP7lYCVIXZSVm6ukTCtPBvVYWJn2wnsaVuqAxIpAOtrAoVvgoqBlyrF0KwoL4m9MeXH4RWJfSX91hh54z3tlcK3v/KiptAKqNZG2bfA5h4x2p1vGecIPAWXxjx1lqMxXmP6Hu14E+OKQFJnibdxmZmX/UxZuXuWP+fE51v7vcMIkc5EDYUNlTTkqpY24dypj6EK3mlZLpSvM9Aze6ONrcAd/6p29AEA7maaiV2wmL8uIONhVt0+xi69OpGCeRYvodzbe2nlHoCQtRm7pTLet64yX9vK6kVCwxvKstHsvFaW1u8zVmdYTj8U10JBUMQzT9ejCGiQfRfjVitXPY7cGQ2BAA8dpK43792Dan0tSssZhJPRgE1/kX3Ir6dpVvl9waKL71X3Rv35JV4JdklWy7pw4dCnE+u357ewiR0uvdcf/Llqnjbur6lHvfDhxtdjyR0w6RtZDYRDWfDaBGAVhwPsT2E5Dx7evN8QvvoCPhzezNpQWvKvsqnLwIG4r3FTFi1Y/9pyv89w56l/692i/1lQ8V/Qnj5D48qGghdiWecJMpBLa/h9prYMLEb/QH8H07Y5nt1XWTUfM49Mx9Ln927Wr8cRzY/Wb697faXfd+91B72sm6U4sJsmjH8N9UX8HUkfa1h1unfOURuwW55XzVPPA1U5vdcd/KLOSemL1vVsk+bN93l73Wtf+335V+EgwWBwIMgM+3U7cnV2pHE8ea1RRjv8RO3En5OZQYSNxZDYxzjUR1epZl6s+lblBPAh6e48b9XU1c/E22nzHO9jjavD4mqvNh0B5CqA1wtgXxEuGiKIUje2v2W3lJRGl8HqWEXuRs/Y71mWugANaDHsrZ2JReeaausHleG1gtfnQNGOiXpzK53Yj+lesKNtO/uzorozzp4I+A9ZOd8QH8nN7zr173iEZ2K8LbNzszqz4mbgg0yDeN5lrsfQ/6P0n8v3vanKNdkSYU8VqBvgCo9beZlHMee3QFYpBHYTcmpBuPCG1fHv2vxPWnpqmO9Yg+zrZ2truVtdunJHAmcQxraLZGdAR+/Q8m0ofjlLfAVUuqLGrlk6oeCm9Yk9sDom82Fd+MjPIf9vIbQzvi58/9i5ai54qi2hTrd3sxwzB2DP3syCrgYgZfDmfaUFvB1txbQGOCWuZVpA8Vgvyou57jO3LL3uu5s73d4xot1WNy8Z+q4kLFjKORqE9EAoh5NZ042dbmHujc5hvg79rMU9YvO7A/P70BfOoiB0zz3kLlYVq13L2MT9tRcqHCKrJl5CeVPQtOwH0fR6p9ruMNTxf2nbupA5X+m3kWuow+QWKmh1QFlpD6G1pS+CZ+qAChM5dHLhDXHFJrF98m/51m2W8cWD1qKljIaKV4YXD51EbOOp8JJhHycjQ6gCwBSjNZ1kWbFZTCjbs8y7iciQwVA9y5hkDf2VQRHnWMobDyDQYpQGoTfgYIzytxoR/VcovMIrKJ3Byrndse39eD7HdbwnQWatRmPsCEI/m79NBLCgAYCiQo5Y2PydGLTSD2E+02rwiyEIMolptIfKl9D3br4dI/PrWtgKwFr9mdfr3xc0GsQqsUOdZxwo/UkhxehDgPts0IlmwyZbyfdTvdeteTObxRts/ie8bPhP0hZEPY7iM4H+1uNOGbY9yJAutluGwNcX9ck55qTeTY9xE3l84mT65PS/mMkeTLtjXGW14/e+eH6vTWwjv98teX3T0TnHPQsR3mYisRPg80Rn9WN9mh99LpT5ER/eGBbTD7XxKRDxrwVqgYdh9iysZx9eRybxhmXnvL3u1TcOz+mXZWkLAa6W2zG7YEHJqxsPzz35TNStrqzOZvjNTu7d/OifxhUN+ert9a9+hCxhkWgIxyxFLqzp06zfKW+vf+2DbnkHofHpJgS0rpyqrnORDy8tKHnlZ9WegXs27v+N4+jZIP+Jw3L6N7aNykben0jb5+W7kousdIgug294KPlZQ/fbtUL8l5nsjQjeq+L+Jb9y81XiGsDJWV2QdvrXBQsvRcv5Ca9pXB4kNY3f3lRw7Xq0lkOFokJFQ993tNrPMvHwaDuAmA9lzQsvGfLOz+8abAdxuYBoo0igNiKAlU1MhN+V1DVVJpYqdSDuQv4NgqQ0YhbDAfQEqZeCXfA2nmDCudbZqBQxxiqGHV0ZLriuiPkMTraDat+q/Xf88sE/IlseQ9X+DuF7ZWW0BgFTfxmVOy0X9n4KwTlW//aX7UaICGtCoWdBVRBn6hbe6g9lLAuq875tnVv1T3Jr72cyfVCL7/afN3AF7kqNzptyMiIig5sMAHQ+AHyUldIqjuTNL8JqnoJtojl5L4GVBQD81Fp5FVfVVoOq5gr2NQojjWetmedGV7lPkbV4CbLoE398ScimbS73H0Fck5RrVvM8kDiW37a+a4oKPGtbehSUv4RAipBIV2GzyW0DSg9DTgkLPvPG9tN3S37e0P1WtSzhxVZu1iRGbYVE/pbo3DyvLP2c/DWXVyZ2WJveb/YGV4+sc/W9OZbp4Vmqv7TBLXEc096PD2iP4+trU6FmhVcNK/Hfh8+3Q04cQZvPoOy9lGdNJ1PkUJDzDXzpbwBKyQrKcp1/lzreA7Qjj8s7CKTFPCswRXtVaWjWDG28qO26AY2NovR9US/2nKPtS1klh9P+AhkPxPfGpjgCh+ViKH0Pj5WobDOQvu5gvHNG5N1akCgXhQhjlj6N78cG0p8TzPqYlf0WGtdzEManNYHUG/HlXQ7Sr/O/x79CjJeFOoWaKCf7sNSguQHEkNyhi5BnY2gTJ0S/beJ1qyuE5RvDIJoHZW7yCjaMQOt4LZyEDOmscVPneAMiYA8/NrORC5aZtrHcmxzqOv1Yss8HMjoWsEHDsFIli4MP3yIIobArofHPGGd3BO0LoaJBz+MmeYT7TrCWHwDaUUK9m73JnldlRpiCMjEsl4QXXfMDUpAmqi39rwwYGF9R2dusoGbsFxnG1ATxi8MFQz8LgwxH2T1RoVfwQlssurniwYWKn+D7TkNJeDFVpV0i3yNF2HLMtqYCxAwIZi2sqSkrii0SU49A2/sYI3coc3RU0YZFfF+PW+pZBRIQkzE8u3QEq9BFJr5G1w0iQ8bdKkKkQahg6EtQ7nM6N+secQlIXXJhsGYokzcgm/+CNjMWgBSJy4AVdTSU9CFTEBaxDko7mo8PpHjp8VQg0coQvu/gxV0uGld4ca3MCBcN/pKV8hTsa0+0jhW4Qk6UvCz62ajsWDDSPtgMLexemUeNZzUBoUFsjMbETTJEBqDdjPKq1SiI4cP1Mes8MS49Ze0H8H/A0O8Yc81T4wqHxD2/taqvtbrW0jflI/2tEXZKJ7ovgfUdCwTX8O7fgOV8Vm2fccXXfc6z8uoaPdnKy74OrW1GJMWII/MXJdQtFLTc7NkQ651813u/aJBUUS+Ak9rEkYJMmMvgdyYjRe551nd9TICtX8JeuQOanRPfu2Hw6mqdp7V3e22urinjA79Vlne6jIHX9hDcK5lQeH9VljZb+L+oq2JnCFJixn3OVboVsqkAmUK8Wz8rSoBxrQi/95C2jrJugvLeF2+s0u5leF2H4bo4TTUKkGE4+L0cx9uXOD9WvieJCd29mH5MQsGhztP2wat7SrjLtP4R7T0GsIMQRSBg7OPj36/VKdStg9hWYnXfArLvp74DfwfIc1bk+tSgexi/ckrcZXNgaSJS6pQdRYa8vF1qrwA3XWcfAIX3U01TViaqvcfkndYUt/SR6Zbpa2m1D+pkiqn0Zk9acXN5n+b9ezDx1TD4s/vk9DsEFIiLxJiYfe/hzfugvjrHs0LEsHRVIPKd7ehpfFgufqVTDs855uRAzHs2qvQyy9L7QzlFxtZ/Pzzn6NZOMDBYsk1YOW2QS8/hDd6HFfM5Wto7AB1flO4IAg7r3fyoblBvR94txQA9KOaqu28uHrxYvABOIPgg9c2pPz7F9Z5lzJ4kV7zHXE/tndnvP3zrKr5nP/rr0KdZf4Jj6jhW90IIbBXq9js9sw/70raD95uq0rPSgy2vg9AOPM7u+9QbFW/ADWvLEdknHQ8ij+Tdxb3XH7RE1Hf/WUNX5tRwkW0DCKOJOXbHWUy0muSzIzcnvG15qdJEWgGATOyJ0VWqChXPygivGhrPCvRc92nuQZL+jmX/I7j4lOv68k2RlRKzQC1+ksnm2jH3CRXRJaihbWkDq4DmcXnEAvZwu7T0O5yH32HUtYdtYGXrPAAzDmQcxrvIcGs/rGZShKwgBsZfWSn7wWIh9nhdOQDsCNCPwA0/y7HN6SgZT6Smpp3PGFHGm8t1XYVxMC7Na7Q7E0P2bttRh9VUV33DXAOMhQHorePvc4ilJzOL2xzji0cKC/5YBZscAYdIAyB3bcwO9NoCGH6gjDy/LrYUluelkvwxhxU9dmTH2/ZMbJP8u0GEhLrdkRFwAg8BmGVoDGfx90xcyCf14Ch9gfFiF6mAfUqaSr8LIMGbEYMUsWYRZYRBvdeoQRvSX5iy9LC4xaG+DuQtV5HM9tNo3CEqXfXg3QW8toYxXQBVzuTSdbPsR9CgPuajvgI4H2EEzgbIFwP4AqzhSSSu3S5eVVjiw+GCQfcau+xGCzuBddiP7MYCEcgA80kV2fil5eqnvi744Gwie58wRhUrDrakNGz2sUUFH7IqQKLRvVzc+ZJqWl1ZfRPjfQSismGt78Q8b1RcvsnHMUH8AkY79hkoDaO57eu4Br9b3SKxFeY4h7meAWuuCgTse4WV1W318x0waLjItq/Wed1uARBl8NFbaRkHdOIbYD2fTvaD9dzrRKyPo0F1PV5d0XAaLHHe6mXfj+3xHmwG+HnLQNZAvvBVVuJe/C6D6jqR6jk5y1hffLsp4jTOCg42KjofV9TpXtS7IzFFR+LZTQNWVWJcHzmyPxb5Vbj77yZAdenqxYuvEnd5fpep58Je/g51787nwLKtDK7fAbD+qLMjQcCrzOt6WNH523IKwj0mm6roFJ0SOBlgi63RBE10aPKHi/mAUnSzIAQ30LitGZ8NrhDpVD4AjeV6GMA3xA4eT/bbSBs6aGeisYsJeyyKpph/x9zYo1K/1eJlHs7zR2ABkoDwKRT2enVV9bkggzgHqTRaMjqiYyXvVoCckekchW3C99iHQBEfJSJDxmGDzbkbHE+ofUth1XwCw34brego7Xmvyha2+ENLtzJuZBC/WTkWssV7WLu2EBsLxHwN0cNizLxAsMkW1Tz+Xn3/EGtRac5Q1OHM0gpvIkiWUEKdIrYMecdPSuQRT8DYrSFDXtwqQvyeN1Z6rwGojTUmNtKv868IvRodtAfg8LueL5oRcJx2/rMGr4R8sTHEml7m6Zq4v0hYBFQ6EoDfgTy6TFvBSf7OWELGubAHAKja4L6B79ctyJGLqLm4bq1SiwoWzmF+VSgP7bGuu8nzalV1v3ZSprMK55B1eDXa9vTQkoHvyjPmtIbVvgFGFHEtu448kOfJBUXgXYio2dcF70/OzIgblygqdUvMtsfB8paTIvtO3Sf13zn1V/9cy7L8B7Rzesz1poq7++cnW361RIK+Dw+/AlvhAUs74S1PNv+Iu7fzevYTm0aqbK2y0Muz4e9sKUjNxeu6ux3zsC21hGNLkUdtjOvOiNmB4zDovqFtGpmFC3Ggp4ocE89A42z7AmyPTIhgdxC7DwDGASmuf2wHo0rIZplF20i+6tUsZiJY7c7V2COLYp5bjeF6K4qC4wQCra1oVg7jRy3PspkBcRWTw1JshLs/TigyX/qdiyE4YUzBoE/l3i8QSVfk2+t75fUkimg9DDFd6D/zr1jmF4Zzpx1j8rKeCplpbGsY8oL/rL5rgwgZ1em2vzqOHYZans0vHAQ7qBXUyZ1AURtTIzXPg4yHQExmzFSnJLfp1rIbddYY6uMIQWOiqPdofyPdsuFGpXuOtYqxyvjIlrRrisesBNn1PSHHg1ghnRH+H0LCZdK3KAXhrKnf8u6jdIVhSAEisECMNLMOwAwQZMSr0fBs7eyLF+BLy9Z9HOUQfyclydI/MlZzpEgLXi1Hj1iF+kzqjzoAT8H4uBsn3jESxtWzYJmP4b19ltRTofR1orBgD71rae8NT9mnRqPR7xHY529+pc5FPBxPqafe/CZv9ZWEhP9FjP5G3zCt05CbBhGS4cWW1SinAH66/43tb315/HJRW39ZAGrj6mDqbPYDXG8bcxyAR0jGqeoTgNQOasUDi8hXoob6BSNM6zbYCqvg8ylAUthRZz6dHVESI9Hfg+jm/OEx1bAcsxBhvi/AWuP3IBZ2qNPkntpxPgW7cS9vfGUYdQBUuMJvx8IR5woCyOxF/tBGVsAP9Nsa9HVj/ApW3yruG7Pn5DDhWSD5M2TCAfyKI1/6icQqPk1NSf+In6cSlMqjzXJ+f0yQjfmpoTgoKwNB+3bG3yTt6yvfdFhNhqfZB2R/VVUaXVVfG6lrECEjajeqXC+pPCkp6bexbL/GDTE9Oe0G6q6o0d4w/Hp7aMu5JlBjPS4dm5h1hKpIjalg0AuvvLCaeMaW+DOAjSJAc3CZrEc1neVhg2RUx6LljYMciaFSIsGYW+HGoumutWeKk/pjRLm3eSb2AG7mI6TvLcVzsTMCqawK8AbIlWlCgrb4r7YUACsu+HfJGulcHdXjTaQqlhJMdyvtapOt04MbyU5KWV9TI2F4k+m2wQV0pKXdKhSLuC0lHRFKXoCwf6wkpi+dWTyYtrUlpmLltrEvtzQ+t9L0c1Rm5d3+M/8aZ69ZgeuZHezRDcdVfP9hPVernro6VWMWD16CsD2XypxmjjejzkO50fAoY+cJj2YdDELTigNNstbFESnIkFg80ApvedfTP8nuJe5bQakgbEjpcEnZiZZESjZFKrVnXZ7iOWxPCJwlcROQ9znI2B8KtCYnHByDo+NI6oqRJUcC9LLOES4AABsISURBVBPo7wdyjHv748QPq9F6N4ckBthhsUQ+GzVymli2mZuug0dJ3+LdleS48Nprym0iXKyozq6EqD2r2u8n6kX7i+snmRhx24i75RNY0rU6sxLNTZIs6pYm2YFZAiM0rEu2hQx5c5sIER0a/Xw8VL1Joml1h4vfbYQyL/AKSy9iQkex/FdIrSSqsePoGUkiY7fSCiaVL8amPLM9dyU8/HTU0RdgIR3i7YlF6/TsmQjrx1hfRxOuHR+Jxu6RZzgGP4HnFEnfbFe7RuqkYMIsLS13e7B3ZL54VU2sdC9YoLhi4kVr90rmVohdcXJUqzeG505sHEPt+b4w7XjYZDeELd7c2iK2DEg9kCjgZyQaDWA1fSZP5DtI3r5vc7M6F9bloaSuvg/3eAKlQub3C1WZdKGzQVq22Di8TJOtFwyjhovo0KZF2gPo0HNxmczCFwNe6pbDmx9zjPHcUbp5+llQa2PG3JtQ6et9mh93DQJ3o2d5zZnsD7xYBFLcBeteXXJYSc8Sq0VKNwDNoT262eHZ/Su1o8fT857ID7F/C2m73rGs/r1z+nmLCt+f36JZm5HadZ/3tNUDP1czCSkvWPfaysQ0pAUlC2oWrH/1O5lhftfpF+NSlxBuqWhgYwuGPHdUzlE52gqEM3IiZ/JNLzF2Vp+m/SK9Wxz9NztgdQLpzWBVkjrUzV6y4XnxPR2ec1wfFJDjjsg5JnZYdj/v8JKD1/k+KcLH+0JYR1VHaq6xbVQGbXYjnLsgEUKfqk89vvkNQsfNjmjeP5/Q9fx5615BLtZfGlwhQs2uY4uK9qmKlL1X/+vUYhxhfGHU6babSmPjRGWMt/UkVSau+XSGLiSi1x+ZGefLogEZYzXn5QIotQfsbRHvfwUS/gviSmmPcqBPQTCczvMO8SQJ7b3lObbEIJ6jba7kDEs2TPK8JNZCkt51qLUdGf9N2F17MWylna1TW5qyDVfXVNaw38Tqwjjno2X9Ey1rWDBS/Qpu604oAG1IcVnBHOP5ZgBofxD6MfM9kJUziyz+krB/zAdzJ+5zdWogeCmIvx/FQ+BVf9lQ+ia7glcgD//1q10ncfuhy6HHk3CMH0a2JLtsjryuKHFE2d0UVNbc/IJBf0NwTwIIedgAJ6u2WRmkWL9I28xozDo5aJmm5PP+x3+X/KhzcdTtxj2rxH0hXDBcMtofRNZIbB5nnQmyUthOoOaDhC9xRJ4IsmpY8ymozW/DyHYHWPvS5icoGzc5ijGIAlnLYVPYFeZzVOdz+b2SPiq4/w/3LZD/p9N/Ku0R3MTwjfkrYxXy7otQeG/eZ1r6M3/7QX7u7ddGY9HnJP1I5j5kjylpTVZtjArCYFVv8r1rCS/cbbTdiS3Xi24uGPKBtPPL2Nwpe3vavgT5SoKfmoNP8HWI7Recxm+/TZ7mNwx1ntoBChHqHIY75Y0t9d3ITPcC10JtX0KJ7N9j0XvWvAQnnBqbd9t+UNgAAHFSuYkcKCkxwrMlhZ93fmQVtMmK6WmljpmGE7EdE6+i/bPlZdFnm2RzUABCWwAN4FoBxHlcD2ectgBxASpnATts90bQNAUnC5RjjtaeWau03YGZvMGn/wPnMR5bu6lLCDbZuEWO3OG5sTtRn09yPfdjOE8/U6VuEUVDooaWnfIA4zxRXVX1XOLe9rixx+qRWIkEwGBd168uTD/lXnV51IcNCGNsfS12zOlwgQZVXb+9XBtkWYmN5DfIOAO0PpiIDKkPL7peNItOfPgJaCJs9tR9EQKt5RlJbMczqWJPOY/AvWqgwNPSN1biyeU9PhhqwAjUK6DixiXabU3fV8WiajhuK/GqPprR1NkPo6tnHBnaa4MQXSnuOah3AoicCOabYzOcDEvpA7LT2W17KYjZGNH6VSzk0RKBRCW9gzG6YwOst2196GiAJ+P7BSXgM1hNM4C+ybFscgXMCpmbPC9R369F0N8Fuz0mNT11Kd/yAmdv9ZBnwGJ/6isQ1uQF64OB5A+JyJA2aKeP821vssvqWLnfnrJdCMGxOEImXAvwX3bLoG9AqfdIpA6gvYjOL2oyYSdrEVR7CsDBCIvvfJ2om2Q96/cQdd05LPfzYSOfo//H35EjLmSXk8TRMecOwNj8AZnc0cTcuahnP8DMBsj7YvzJ+VexGNkoYnljVJKHNb1GV8/FMMmRFS3tNmwyy0DGbNhaR5C4xrasvnKgmTyTsrHCexzhchLA5QA0dY2pyn5A6i9T9wRynPa3s/Lb4Ks6m70jbYDBYzEV3RT33mr9F6j/u28KF57DN3+AmrxC3ksuzHMMbpemmxOwkx//4n6bCMElMoYPiUKVUFoDxTOr+Kj9cF2fJie2wbObiu0h+bPyBlT0Io64ByCrw/ioh/xexi0ZhhDX/4W6+ViztjaFFGATP4c17Q9GS3B57KVi9mPh4uGLQFBHqD0isXhBPj6oO+0AGwkk5q1086hrOpGocD2a2MFEGc8TdpSZYeW72pAlSTCMGD3IWU5i9gmSTS/zyMqwRJVfjZXelO98Q+wmqW+VW3EVgEZbNuv36trrR6tZ1kc1lVWv3VI0fLnqmtWLlfU28qeSzUp34tq509glk+W9+gorfwLza5t8hmR9bbeKEKESfEnFyKAuAOsx4tVhyWtK1hLkdBw+5kgccneEu0w/Es2mWGdl3rJ5QAJP+mH4+ETu4eU1b7P0b9wymaoND9K/YysnBlI6YLsMQhs7BMCVIYT3x+KfJVoYCCBMiruDUCpa3ZEoAgWsiEp8klGu4p7BQPW+XB9bNsb1zCIEcypEAOHrlbC9ZhDU1yQ3PA0BxGP0BLj+IfF3ELUbc1spLE/ZpdhAtYX6vaijGz2F36cwt6JAWlAyJ0kJ0Icyj2NYddmpkfTrQdoXyVso4qcTAQuIcbzADpbWhPjM95KDsHmIei8Nuk6kdZwnFiqZZHyiknwAxfIRWWdQd7W02VK0/oT08+/JlZpIEOYcQpbxpS+yQM43SUtJXQxFfc6upoVY1nfIshdNRYJAAPstV3uHgZgNQFACVDEQ3N249oRw8cC4DwzqPpbnhNK15IStI+P9fGTTvam4ieHzbahbUoX0r1la4zl5WgzCJoCzBMF+Ed7lb3l+Sjy5Ie82AoLOKUgBlza7E9qdi3p9OPcP+UCVuSGLJhjbDEYFvgC1eC9kVZ61seyjOCvUpil730/plnfwATWByttZLc/Rf52i07IeYl7LY1bsruQtdHUaJt1sFVtJbZXtENCRHKvKrGG/eKajs11tz8EqflN1ztyD562E3Um7tEDweD44CDDfJ9GgP2p0C0nAI9rYTp5LMAn391L4dVPkzteyYlBi3wsX1SJD2kDpn4CotvSDAy++Ik7AYXZ6zHDUADEZ1OAMwskpElTjNKDLadOD+ixeXQur7C67bKUfUdtZgT+B8Cryj5/Qtn0Csfh3fYfkWLzcVl7W9ygxL5EvMJJgcjHI2Jsg1pnhNeFK0kKOoJuDuuf1uoc57ccqbIJs/Zf0nVjwgF8GcXXNKiH9aQfKdiNEllpURf8JRQ3x+WziOKPjGyn1s66r34WnXs0m/wthDwCQHTau/XSFF2mvXP0wvGk+AIrB58UofEncGdJGEuSEvaCJtUVAfom8CGD8nS/PpMCHrwfAn6EOzwUpvWEZX1ZHa2baLhvnxINr8FkFU+IqZ9wvZkwhr7F3RO+ODTNBtimIXIOFjITFNIKtvWwr9xquC33bIe4+se2HmYMAfVW6CvYhzcFK3xAdPmbJwP+KTYGA7gEH6MPfZaxAQgZqicwvuYhzloS6MXJgTvKzrd1vN0Kg6DEMPscX1PV1arnum47DTiRtNd18vkknVskMCcOK7aEdF7vDPKjcsgnVkaonWW1fpKvAMX5f7Kh9kkTmD1kOh0KVuMmt1bzPOVWTu0ubSMwdyLlVBIP0OlTr8lQrrTH8pwrk1Miq0rGauHUtbWPRyDVoeJd4UXeAW1g6WzIO2Xc+gzG/Qk39L26ZK1mxD91cNOQVaR8vqeo8xk71POtAVhg5ZWoMrPGFysxAPNrIihoAm2uDtX4Xec7340sb/E1B65v815OvtUqLWYByMTD5WUP3fMu2S+2ml/Q7UF1rfTCaPCeDtuKpz0JJUUQE5YW4o9LFmwtv7o5G0xp+8s9bC4auEdUPTawD7JtMDut8gDjXdp33RhcNXJ44i/gmHGMPBDhzUCraQ9GHAKB1rJD/iAXNhp8m4k2Wd+LnpgRTh+G3+hEN5KHEncDxHV+ZjY/gBAeAazIhqI88Nj2yYs4jYW6sKAvSh5xGWmp799R43siArY8D4bdjoA5nn8cWzZKVBRu0gmUVsfslK3N0l8kHYLecRBR0lPThF0yEoyAWVpJqx3hNpJ55B9iwc8X27BHZLoT4g/lXOei4KhAkddReXHsUhv9EKUmEiCoXi1ttCCp7bETFRvC0czTqXttCB34iGeFN7mXcVmxqOjRceO3qn9+u+yuUd/tlGH/tocqVvLAJn8aPbFH+O3aJyIViKBh/mV3J/ZncE2H0FuCPqiAk1RVXcA4scQ+E8msoIi3RB6JoOsg2zlipKn3EzyiRb6kOBhHK1guxqPd6RY1Zlp2muqD3PcV4E8igmSX+MdTpZ5nDZwC3EewxU2aKp/n85F22sNkhEAAObXWvTzR1v2rrd9vNshK7WR+Awyv26y0e9GhivfyWGAM8fQ4AOqD2t24hyAgG7EHCunDh94H67iAkun8iMmBNPVGH62grkmcVtWJ3i8oIDtshUNvxLrJBr2b78nK0m5boXeJlLpYVhDp8chz4GLFMZQUa1gLPIm6P/cG7qooDzLCe7/ORQVjVrgmmjmdFVALsr9mM80TTxiktvlry4ddelKgh+yJF9U/VaffBEYaWlns3wlYvRa1biGJwZzIyGBN3adlMCORQVVyyJZ4i9dtbhFJ3uIhuDdU+I9pRQy+zdO/2YtEZBJEuNZvcm3WG9RpAW4jVTiCnbpGgE3GOL6DioXIuluxx33xq6ZaGotertKaHsWJIaVWiFu/GCmCHgH4Ow6AbfEHCuF/yQaei+RAv1wEQUoZTcen3RY1eTnZrhDpO6US+1jROATpbO1lv814zz0R6ogweCALPZWWcKnlprXK7kk2jjoVdf87qAK1ix5iP4/m+W2ZX94ewLRC4D20aNBbrvvHz3Q4jRDbtB4IpQ8Tv9HM3v/wlm1RSUtUDfMjLhGm/QrWUHNt2yI3/+Nkn/lsg+D4++gTaPo26+wL23AMs+RMwDNMR4gv9dolX0YjsNAt3iGmHyhsxHOcDkn60tfu9W+OulaTsxPb+b/FllVeZT6woafPZgRV8Rws81runKOs9AP0uQO9MfOekcNF16wDsJJIa3lpTlDFPEBqPfGZmcfwgJwhto7DaH4koc73Izm00rfN4hxEi5j+UuQ8AxLLGA0VBYPbyotaR8Mw6Hk3ZkWoFnQnYJp9giX9Ems2hwj5YXZs4sSEs74a6Tu0LT74TobdfIx0YTG9hzlQ8ziEmglLAiaaDwyJAraLy/2JIRuSdX1PQsnC7q2VYy2RAqs41NfrElBTzCq71AXIi3ObdvKO8srQr1JrVMSs3M5/xD2asJcyPxatSYI3pnOYQ8pUBfx6cWiTOS7RGcn2laDZek9wBgczHvnnQb7c91x1GSHKncjS41YxtCgWDz0t+Jvc4CTnkzLoF++VEjK3LqytTJqSlV9+F9lSgNpZOWrNmTbR5l857iI8IgTgL7FZWV1SP4viOouoa1T1o6yqyO5Z6puYv7BbYnS73J9Px3vrG8uskjtOtc8+2oqLjioGadQahslTc8n8l/n3BZtfNpdR/hyIwU3KDE9/tnttrdPJKxv1xb33brv33WE1PsanpLPE++HW/5vqrhHriQDo7S7y0jyTWJf6WDHCidwMJcJ5DfdaEb69inwZCF9aks7Imt2zZMiDIEBaEprObKS0dnpIe/AdU/G/ZZGk53iWwkZfLSy1JD3qEv9sE4IljcI77VN8tDmCW5nbYvwM5VktEzYZqvwfJx1ZXVD0MlR8vJ8HBcsaDnCGI4H2xmTr5fUn8nP2RIEdHUMv7QiAP0N+j/D2PEH85eQ+8/55coex/qS6ZuGR+W/nNCOFj+7I63tjaNGQLAwBeQptDN/93QxHZZoYg3sNqknm/OCQlBgF7OjbunmDrG8BqvNmFPsiKWVM5mZRj9/SL9LFMqD9xPFgDJ7l5snqkNLWrKolumjXYPDegGvcEWgcQXEJFNi+ypS6+kuOEErO6qoINk3iHzZlTr8bPJvvfUaljH1V4NWPWx5ZfRT8VpAIQnxlSRwOMj5Twz6qCtGcwZk9NqPpVP7fqXNxWj6Nzp/SB0m1xR9C2HWyBsCv7w7V1+ZjFgz5PfF+CNaPzpq1oku3cTtw6u/YZ+UyFZVeyM2s+VDgg4kUnxt3bVim7sLIbw+KeATEPuHYEt7l9FokJeJ7xztogAMT4/eNdZiMobIkCAMsjqcHGKWxtQEV+HVgPYk45YzvP6EF66t3sCryBZtOlrcg8XPj7htTUM/mMn9Dw/ib7Nxzb6d1I27MaOR2bua43Jn/JsK+kfWIRImLFhZmPhIGrCacsh+iaiXtlTOEv2ye+u7XfvwkhjmdVkhR4t23bS1ctTlshmgj8ec6YxQO/UOoX2q0Sn9HY3GnEOMxYAYQIy3wVNmEzvdCrcG8KNHIeB7mfsbOVk3jYMg7MZPK4HqbiROzbKFZdVB1IuZv3OiZ+FOxlLdZ8Z7EZtKoMKsmzMOxd1NZeaZHqPtUpqXNcO7abZNnzXpytiNqrAtbxsJrmhJzfwnbojS30KKttMUT2E4Am6co+7aYlg7ekFSWO6dVseN9Kyyrif1m46Fos/ea21473vlJe4DdxHeaz80qtrZB1J97Pi7bWqzgUG1kpUyHnnsQoBti2OVtVxe7QaYEhZA0+4RlnjLhmcOTJeb3zE/uKZ3xw/ol/Tok8C3WZ1IP0nsdgaQECTW8guK+RFCaiS3sn/k8G8fmlZPaiHadoK3bL6Uqgtw9jza+K1jwhp6OClIe4f81Ulz3jG5CJ4yf+FvkCuxYZSnc7p+xUhDDBoxB+rVH1Zsv05OBhckp6iP+pvunW7gO3cfiZlfh/5juyzZhYCN8nub9sR9Z/4UtJnFDrbc8bH424bnhlPIZfX3cN1cU379NnJ/o+EAUBbzE+NmUy7Zg1aXTxoKXieIT/s79RwZoMZ5TUZuknd8j3nVzDrmLftogHuLRHkh7ycCeVnYoQ2NVkgLsEw04s5xa4PL7FH9RZrN6G5hs/Xyo9tR8+qNMwyCbiqzpzY2lstAjxsnJvKEdA3QkeRgVtaz4IIuJn2tNvOVqS+LNwUqp2KP1vcXYWe9c98r+sttQR5FIVrIDdYV0kVqsluOmJTLlXyDwabYiNLUkPZART1DAQsxdVJSDpM5SKaQ3NU+pJc3qZ9ov4NrJfDIqDWsO3BlklE7b23o48+00ypJ6B1uHUK/ei0VvjZ5h0C3EoWZaEbhssm1NrHidY9QHBoov5yG4Z2dbeADRNrGkssg0BuDk5YTM4KuMbDDs8aTxHYJPvdA+C/ipyd0lG0HOIo7TlejInmJyubXOTp9R/+A/CLumW12ukZ7sXsq1tVItOXbpXZNkPB7VZzqRaICseFrd/gxOs++BHcnSHU2Uk4BVgdxYrO+7Rrdvs19/t1BWSPI24bcB2aWTKVHkmoVGicQfwUR8kt/XvN2eLX4GA7ALVorWJd1gfbKpLh0tYFG3tDEmoiyozMhBPqrN2V5YzW5vowxiUF6elpR6Ig/E4xhyEgiBRu85ZMWtkieUewuqbgnx4j7FyOA5jXFmJu2Jr5zLGs1OKNizE2AO3skKm3RJxvTu3Zo/43/Frr78rQtj9dDL/f4jnRM2HsVRzKWT+FwZMByHHbc+E5UQdlvDhsAdyftnTwSEEsKA3iYa/yO7XMaZyw2loOvyHKxhleHeJVE41ldGrrFTZi2hdiMPjLq5k5cvZjpwYxIEG3qa0D+o7HqS++YCAdxgPDU594FUQWGtk/Z1Ye3HdU4rqe/PX1+1sllVnJrhHOmrL7RtN4ewrY0hDHToOPjyrTqOt3GzeZSSh2HieVMuWKKqNq3qSn9UfQD0PMjg0hjXAMUhoSxnw9lVoaiOQIQFCvTPg941sz7o6OQC2lSGTHumleGwvlJQhK8ObBDvtgK0lXol3khrutNvfFSHM8u1qVT0r8YSdxJlLsnSqbW6BxcyQNJ3EZ8m/4+7zNaiqa+IHI8/b/Py+5Ha/9l7Yk7a9U1NrIvmbNytt6Wqzx3mhHDATCcTzkbc829k/fleENBQviafZ5GVdwxm+wu+/hLI78GFbRcjO/vDk/kTWEENZzv/Ac//YvKmvuQVlDya3GYlvjTr5+90KK/2PLWhPrcjZEgdeMcbdWYwu1nM7fxbsG+wm6qV//3tcxTmJfJjnpyHJGKJOEyV8DqVhgOvZGzUHIcMKM3+P8bfW5x+OEHKyZhmr9PQtxmK5/IeOtQiRQ4v5X3ZGwPuL/dxcmbxkSuZ3mXJx8odIatL21OE6vyKxbfcuh+zLex+yKiby37IeK32gALRetOz97+V3uGjQU+wjOZsVM0fu/8iCAvG/L7jJH2Mia3DW/SinnorTkjNvO0Gt98WP4eC8KWLnOTXRyrM59GWtzFj2paQYa3biEbSSPUISxctsJzjVz2CXA3QCduBO3CXLiVdcJSosfrQRtjEvfVX44SL5r77pjk3EqmNDMR0Z748qv6CwP2rgxHFQk5qhLb0oyJD6UtdZCIB6+shArb0Tt/iYYCDtQnkuLIddPjNwCL66V26vS6ROCsgYilr6tJWmZ9TWcJyPE7iMxOtryAF+nvNG7pGVwnhxj6zszMI6H02cngS8zTu//Bf/R9c/BULWu9aJ+L/e9mFQu9tV1zmJTc7CxXVCAht+mbyeYYJeDxAGngav6St5WvH/0kJxIGXREGwP84r8lxNyzhfv7Ck7iSUhDrb0HIbp/SCbVLGfizgqjb3hHz/X/O9+/SkQkrzdWMCBaUyqTd1j8QD067jip+A+8XwvLjGP8WxzvslKC46JxKywvCuxFy7tcpwOk7kSU6kttU5D8wyy4S2/zr/6idb+/f/qCrH8/1Mkfq+bZT1K5vmpiadlozHdxUooY//eCP9rJEbBgZxPy37H3xrn9vvcda0HAsnxdGki7ErYVnLz+tomt9l1vwsCuyCwCwK7ILALArsgsAsCuyDwfwEC/w/mP76OZqN/2gAAAABJRU5ErkJggg==">
                </div>
                <div>
                    清大
                </div>
            </div>
        </div>
    </div>
</section>
    
<div class="container">
    
    @if(!$games_inprogress->isEmpty())
    <section>
        <h2 class="sec-header">
            <i class="fa fa-play-circle" aria-hidden="true"></i>
            <span>進行中賽事</span>
        </h2>
        <div class="gameinfo-layer">
            @foreach($games_inprogress as $data)
                
            <div class="gameinfo-flex">
                <a class="gameinfo" href="{{ url('games/'.$data->game) }} ">
                    <div class="gameboard-background"  style="background-image:url({{ $data->photosmall }});"></div>
                    @if($data->status=='inprogress')
                        <div class="game-status inprogress">進行中</div>
                    @elseif($data->status=='prepare')
                        <div class="game-status prepare">即將舉行</div>
                    @endif
                    <div class="game-name">
                        {{ $data->name }}
                    </div>
                    <div class="gameinfo-info">
                        @if($data->status=='nthuwin' || $data->status=='nctuwin' || $data->status=='draw')
                            <div class="gameinfo-score">交大 {{ $data->score_nctu }} : {{ $data->score_nthu }} 清大</div>
                        @elseif($data->status=='stop')
                            <div class="gameinfo-score">因故停賽</div>
                        @else
                            <div class="gameinfo-date">{{ \Carbon\Carbon::parse( $data->date )->format('m/d')}} {{ \Carbon\Carbon::parse( $data->time )->format('H:i')}}</div>
                            <div>{{ $data->location }}</div>
                            @if($data->is_broadcast=='1')
                                <div>
                                    <i class="fa fa-video-camera" aria-hidden="true"></i>
                                    轉播
                                    @if($data->game=='men-basketball' || $data->game=='women-basketball')
                                    <i class="fa fa-eercast" aria-hidden="true"></i>
                                    VR 360
                                    @endif
                                    @if($data->is_ticket=='1')
                                    <i class="fa fa-ticket" aria-hidden="true"></i>
                                    索票
                                    @endif
                                </div>
                            @endif
                        @endif
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </section>
    @endif

    @if(!$games_prepare->isEmpty())
    <section>
        <h2 class="sec-header">
            <i class="fa fa-clock-o" aria-hidden="true"></i>
            <span>即將舉行</span>
        </h2>
        <div class="gameinfo-layer">
            @foreach($games_prepare as $data)
                
            <div class="gameinfo-flex">
                <a class="gameinfo" href="{{ url('games/'.$data->game) }} ">
                    <div class="gameboard-background"  style="background-image:url({{ $data->photosmall }});"></div>
                    @if($data->status=='inprogress')
                        <div class="game-status inprogress">進行中</div>
                    @elseif($data->status=='prepare')
                        <div class="game-status prepare">即將舉行</div>
                    @endif
                    <div class="game-name">
                        {{ $data->name }}
                    </div>
                    <div class="gameinfo-info">
                        @if($data->status=='nthuwin' || $data->status=='nctuwin' || $data->status=='draw')
                            <div class="gameinfo-score">交大 {{ $data->score_nctu }} : {{ $data->score_nthu }} 清大</div>
                        @elseif($data->status=='stop')
                            <div class="gameinfo-score">因故停賽</div>
                        @else
                            <div class="gameinfo-date">{{ \Carbon\Carbon::parse( $data->date )->format('m/d')}} {{ \Carbon\Carbon::parse( $data->time )->format('H:i')}}</div>
                            <div>{{ $data->location }}</div>
                            @if($data->is_broadcast=='1')
                                <div>
                                    <i class="fa fa-video-camera" aria-hidden="true"></i>
                                    轉播
                                    @if($data->game=='men-basketball' || $data->game=='women-basketball')
                                    <i class="fa fa-eercast" aria-hidden="true"></i>
                                    VR 360
                                    @endif
                                    @if($data->is_ticket=='1')
                                    <i class="fa fa-ticket" aria-hidden="true"></i>
                                    索票
                                    @endif
                                </div>
                            @endif
                        @endif
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </section>
    @endif

    <section>
        <h2 class="sec-header">
            <i class="fa fa-th" aria-hidden="true"></i>
            <span>所有賽事</span>
        </h2>
        <div class="gameinfo-layer">
            <div class="gameinfo-flex">
                <div class="game-date">03/02 （五）</div>
                @foreach($games_day1 as $data)
                <a class="gameinfo @if($data->status=='nthuwin') nthu @elseif($data->status=='nctuwin') nctu @elseif($data->status=='draw') draw @elseif($data->status=='stop') stop @endif" href="{{ url('games/'.$data->game) }} ">
                    <div class="gameboard-background"  style="background-image:url({{ $data->photosmall }});"></div>
                    @if($data->status=='inprogress')
                    <div class="game-status inprogress">進行中</div>
                    @elseif($data->status=='prepare')
                    <div class="game-status prepare">即將舉行</div>
                    @endif
                    <div class="game-name">
                        {{ $data->name }}
                    </div>
                    <div class="gameinfo-info">
                        @if($data->status=='nthuwin' || $data->status=='nctuwin' || $data->status=='draw')
                            <div class="gameinfo-score">交大 {{ $data->score_nctu }} : {{ $data->score_nthu }} 清大</div>
                        @elseif($data->status=='stop')
                            <div class="gameinfo-score">因故停賽</div>
                        @else
                            <div class="gameinfo-date">{{ \Carbon\Carbon::parse( $data->date )->format('m/d')}} {{ \Carbon\Carbon::parse( $data->time )->format('H:i')}}</div>
                            <div>{{ $data->location }}</div>
                            @if($data->is_broadcast=='1')
                                <div>
                                    <i class="fa fa-video-camera" aria-hidden="true"></i>
                                    轉播
                                    @if($data->is_ticket=='1')
                                    <i class="fa fa-ticket" aria-hidden="true"></i>
                                    索票
                                    @endif
                                </div>
                            @endif
                        @endif
                    </div>
                </a>
                @endforeach
            </div>

            <div class="gameinfo-flex">
                <div class="game-date">03/03 （六）</div>
                
                @foreach($games_day2 as $data)
                <a class="gameinfo" href="{{ url('games/'.$data->game) }} ">
                    <div class="gameboard-background"  style="background-image:url({{ $data->photosmall }});"></div>
                    @if($data->status=='inprogress')
                        <div class="game-status inprogress">進行中</div>
                    @elseif($data->status=='prepare')
                        <div class="game-status prepare">即將舉行</div>
                    @endif
                    <div class="game-name">
                        {{ $data->name }}
                    </div>
                    <div class="gameinfo-info">
                        @if($data->status=='nthuwin' || $data->status=='nctuwin' || $data->status=='draw')
                            <div class="gameinfo-score">交大 {{ $data->score_nctu }} : {{ $data->score_nthu }} 清大</div>
                        @elseif($data->status=='stop')
                            <div class="gameinfo-score">因故停賽</div>
                        @else
                            <div class="gameinfo-date">{{ \Carbon\Carbon::parse( $data->date )->format('m/d')}} {{ \Carbon\Carbon::parse( $data->time )->format('H:i')}}</div>
                            <div>{{ $data->location }}</div>
                            @if($data->is_broadcast=='1')
                                <div>
                                    <i class="fa fa-video-camera" aria-hidden="true"></i>
                                    轉播
                                    @if($data->game=='men-basketball' || $data->game=='women-basketball')
                                    <i class="fa fa-eercast" aria-hidden="true"></i>
                                    VR 360
                                    @endif
                                    @if($data->is_ticket=='1')
                                    <i class="fa fa-ticket" aria-hidden="true"></i>
                                    索票
                                    @endif
                                </div>
                            @endif
                        @endif
                    </div>
                </a>
                @endforeach
            </div>

            <div class="gameinfo-flex">
                <div class="game-date">03/04 （日）</div>
                
                @foreach($games_day3 as $data)
                <a class="gameinfo" href="{{ url('games/'.$data->game) }} ">
                    <div class="gameboard-background"  style="background-image:url({{ $data->photosmall }});"></div>
                    @if($data->status=='inprogress')
                        <div class="game-status inprogress">進行中</div>
                    @elseif($data->status=='prepare')
                        <div class="game-status prepare">即將舉行</div>
                    @endif
                    <div class="game-name">
                        {{ $data->name }}
                    </div>
                    <div class="gameinfo-info">
                        @if($data->status=='nthuwin' || $data->status=='nctuwin' || $data->status=='draw')
                            <div class="gameinfo-score">交大 {{ $data->score_nctu }} : {{ $data->score_nthu }} 清大</div>
                        @elseif($data->status=='stop')
                            <div class="gameinfo-score">因故停賽</div>
                        @else
                            <div class="gameinfo-date">{{ \Carbon\Carbon::parse( $data->date )->format('m/d')}} {{ \Carbon\Carbon::parse( $data->time )->format('H:i')}}</div>
                            <div>{{ $data->location }}</div>
                            @if($data->is_broadcast=='1')
                                <div>
                                    <i class="fa fa-video-camera" aria-hidden="true"></i>
                                    轉播
                                    @if($data->is_ticket=='1')
                                    <i class="fa fa-ticket" aria-hidden="true"></i>
                                    索票
                                    @endif
                                </div>
                            @endif
                        @endif
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>


</div>
@endsection