@extends('layouts.layout')

@section('title','關於梅竹')

@section('content')
<section class="introboard">
    <div class="introboard-background" style="background-image:url({{ asset('images/cover.png') }});"></div>
    <div class="introboard-title">關於梅竹</div>
</section>

<section style="text-align: center; font-size: 1.2rem; font-weight: bold;">
    恭喜國立清華大學拿下戊戌梅竹總錦標，若您對戊戌梅竹有任何建議，歡迎填寫<a href="https://www.surveycake.com/s/YOOOK" targer="_BLANK">賽後問卷</a>，謝謝！
</section>

<div class="container">
    <section>
        <h2 class="sec-header">
            <i class="fa fa-star" aria-hidden="true"></i>
            <span>戊戌梅竹</span>
        </h2>
        
        <div>
            <p>
                
                熱血沸騰的戊戌梅竹將於2018年3月2日至3月4日開戰！<br/>
                以下觀戰重點，是你不能錯過梅竹50周年的原因：<br/>
            </p>

            <p>
                <strong>梅竹賽場新面孔</strong><br/>
                戊戌梅竹賽除了10項正式賽外，許多年未舉辦的<a href="games/football-general">足球表演賽（一般組）</a>、<a href="games/football-open">足球友誼賽（公開組）</a>及<a href="games/billiards">撞球表演賽</a>都將再次在戊戌梅竹一較高下，除此之外，<a href="games/darts">飛鏢表演賽</a>及<a href="games/softball-open">壘球友誼賽（公開組）</a>則是首次登場，也是不容錯過！
            </p>
            <p>
                <strong>50周年限量紀念品</strong><br/>
                適逢梅竹50周年，梅竹籌委會特別推出了限量「<a href="https://www.facebook.com/MeiChuGamePreparatoryCommittee/posts/1123278021147087" target="_blank">吉祥物立體紙雕</a>」，讓大家可以簡單幾個步驟做出屬於自己的熊貓、狐狸！只要在梅竹賽期間至現場觀看任三場比賽並集點，即可一次帶走兩款紙雕！
            </p>
            <p>
                <strong>轉播服務再升級</strong><br/>
                這次梅竹賽特別和MOD頻道「<a href="https://www.facebook.com/OurSport.tv/" target="_blank">智林體育台</a>」合作，除了將在羽球、棒球、籃球、排球等賽事導入業界品質的轉播服務，也會將直播畫面導入官方網站，讓你不用再花時間找轉播連結，精采畫面不漏接！
            </p>
            <p>
                <strong><a href="song">梅竹，夢想，綻放</a></strong><br/>
                梅竹五十主題曲，趕快練習，讓我們在比賽現場一起唱！
            </p>
        </div>
        
    </section>
    <section>
        <h2 class="sec-header">
            <i class="fa fa-chevron-circle-right" aria-hidden="true"></i>
            <span>梅竹賽歷史</span>
        </h2>
        
        <div>
            <p>
                梅竹賽，是位於新竹的兩所國立大學─清華大學與交通大學於每年三月間所舉辦的校際比賽。自民國58年正式舉辦至今年剛好50周年，在清交兩校的學生活動上，佔有極重要的份量。
            </p>
            <p>
                飲水思源，梅竹賽的緣起，當回溯至民國50年代；清大與交大在台復校後，因兩校校地位置相鄰，且學生人數相近，而學生之背景與就讀的科系性質亦相似，所以兩校同學彼此之間在生活、課業與活動的往來就相當的頻繁，因而不斷的有聯誼活動。
            </p>
            <p>
                民國55年，兩校之間曾舉辦過技藝對抗賽。到了民國57年，時任交大活動中心幹事的錢鋒學長終於獲得課外活動組主任戈武先生及學校的允諾，開始籌備一個由清大及交大學生參與的大型競技活動，以不讓英國牛津、劍橋大學之間的划船比賽專美於前。負責籌備的學長夜赴清大，與清大學長相談甚歡，雙方皆認為此項比賽對促進兩校同學間情感交流、生活調劑、學藝及體育發展….等等，皆有裨益，因此達成共識，決定舉辦這項比賽。
            </p>
            <p>
                最後清大張致一教授從口袋拿出了一元硬幣道：「出現梅花則稱梅竹，出現壹圓那面則稱竹梅。」銅板落定，梅竹之名從此便正式確定。
            </p>
        </div>
    </section>
    <section>
        <h2 class="sec-header">
            <i class="fa fa-chevron-circle-right" aria-hidden="true"></i>
            <span>相關單位</span>
        </h2>
        
        <div>


            <div class="orginfo">
                <div class="orginfo-left">
                    <div class="orginfo-name">
                        主辦單位 / 梅竹賽籌備委員會
                    </div>
                    <div class="orginfo-enname">
                        Organizer / Meichu Game Preparatory Committee
                    </div>
                    
                </div>
                <div class="orginfo-right">
                    <div class="orginfo-info">
                        由兩校學生所組成，負責梅竹賽事之籌辦。
                    </div>
                    <div class="orginfo-link">
                        <a href="https://www.facebook.com/MeiChuGamePreparatoryCommittee/" target="_blank">
                            <i class="fa fa-facebook-official"></i>
                            Facebook
                        </a>
                        <a href="/" target="_blank">
                            <i class="fa fa-globe"></i>
                            官方網站
                        </a>
                    </div>
                </div>
            </div>
            <div class="orginfo">
                <div class="orginfo-left">
                    <div class="orginfo-name">
                        主辦校 / 國立清華大學
                    </div>
                    <div class="orginfo-enname">     
                        National Tsing Hua University
                    </div>
                    
                </div>
                <div class="orginfo-right">
                    <div class="orginfo-info">
                        主辦學校為開幕、閉幕、桌球、羽球、橋藝、棒球、男排、女排等賽事之主場。
                    </div>
                    <div class="orginfo-link">
                        <a href="http://www.nthu.edu.tw/" target="_blank">
                            <i class="fa fa-globe"></i>
                            官方網站
                        </a>
                        <a href="https://www.facebook.com/nthu.tw/" target="_blank">
                            <i class="fa fa-facebook-official"></i>
                            Facebook
                        </a>
                        <a href="http://eas.web.nthu.edu.tw/bin/home.php" target="_blank">
                            <i class="fa fa-globe"></i>
                            課外活動指導組
                        </a>
                        <a href="http://peo.nthu.edu.tw/" target="_blank">
                            <i class="fa fa-globe"></i>
                            體育室
                        </a>
                    </div>
                </div>
            </div>
            <div class="orginfo">
                <div class="orginfo-left">
                    <div class="orginfo-name">
                    協辦校 / 國立交通大學
                    </div>
                    <div class="orginfo-enname">     
                    National Chiao Tung University
                    </div>
                    
                </div>
                <div class="orginfo-right">
                    <div class="orginfo-info">
                        協辦學校為網球、棋藝、男籃、女籃等賽事之主場。
                    </div>
                    <div class="orginfo-link">
                        <a href="http://www.nctu.edu.tw/" target="_blank">
                            <i class="fa fa-globe"></i>
                            官方網站
                        </a>
                        <a href="https://www.facebook.com/nctu.edu.tw/" target="_blank">
                            <i class="fa fa-facebook-official"></i>
                            Facebook
                        </a>
                        <a href="http://activity.sa.nctu.edu.tw/" target="_blank">
                            <i class="fa fa-globe"></i>
                            課外活動組
                        </a>
                        <a href="http://sport.sa.nctu.edu.tw/" target="_blank">
                            <i class="fa fa-globe"></i>
                            體育室
                        </a>
                    </div>
                </div>
            </div>

            <div class="orginfo">
                <div class="orginfo-left">
                    <div class="orginfo-name">
                        兩校後援組織
                    </div>
                    
                </div>
                <div class="orginfo-right">
                    <div class="orginfo-info">
                        賽前造勢活動、電競賽、兩校各自賽事紀念品等皆由後援組織所負責。
                    </div>
                    <div class="orginfo-link">
                        <a href="https://www.facebook.com/meichuwin/" target="_blank">
                            <i class="fa fa-facebook-official"></i>
                            清大梅竹工作會
                        </a>
                        <a href="https://www.facebook.com/nctu.meichu/" target="_blank">
                            <i class="fa fa-facebook-official"></i>
                            交大梅竹後援會
                        </a>
                    </div>
                </div>
            </div>

            <div class="orginfo">
                <div class="orginfo-left">
                    <div class="orginfo-name">
                        兩校火力班
                    </div>
                    
                </div>
                <div class="orginfo-right">
                    <div class="orginfo-info">
                        在比賽現場帶動觀眾，一起為選手及學校加油。
                    </div>
                    <div class="orginfo-link">
                        <a href="https://www.facebook.com/%E6%88%8A%E6%88%8C%E6%A2%85%E7%AB%B9%E7%81%AB%E5%8A%9B%E7%8F%AD-1571693219711454/" target="_blank">
                            <i class="fa fa-facebook-official"></i>
                            清大火力班
                        </a>
                        <a href="https://www.facebook.com/nctu.on.fire/" target="_blank">
                            <i class="fa fa-facebook-official"></i>
                            交大火力班
                        </a>
                    </div>
                </div>
            </div>

            <div class="orginfo">
                <div class="orginfo-left">
                    <div class="orginfo-name">
                        賽事媒體
                    </div>
                    <div class="orginfo-enname">     
                        Media
                    </div>
                    
                </div>
                <div class="orginfo-right">
                    <div class="orginfo-info">
                        提供轉播服務以及賽後回顧、賽事戰況的相關新聞。
                    </div>
                    <div class="orginfo-link">
                        <a href="https://www.facebook.com/OurSport.tv/" target="_blank">
                            <i class="fa fa-facebook-official"></i>
                            智林體育台
                        </a>
                        <a href="https://castnet.nctu.edu.tw/meichu2018" target="_blank">
                            <i class="fa fa-globe"></i>
                            交大喀報Castnet
                        </a>
                        <a href="https://www.facebook.com/NTHUTsing/" target="_blank">
                            <i class="fa fa-facebook-official"></i>
                            清一下。影音新聞
                        </a>
                        <a href="https://www.facebook.com/gotoandplay.nctu/" target="_blank">
                            <i class="fa fa-facebook-official"></i>
                            goto&Play交大網路電台
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>
@endsection
