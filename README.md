# To-Do Planning
2 ayrı provider'dan gelecek to-do iş bilgilerini çekerek development ekibine haftalık olarak paylaştıracak ve ekrana çıktısını verecek bir web uygulama.
Her provider servisinde task ismi, süre (saat olarak), zorluk derecesi vermektedir. Toplam 5 developer var ve her developer’ın 1 saatte yapabildiği iş büyüklüğü aşağıda verildiği gibidir :

|       Developer         |Duration                          |Difficulty                         |
|----------------|-------------------------------|-----------------------------|
|DEV1|1H|1X           |
|DEV2|1H|2X          |
|DEV3|1H|3X|
|DEV4|1H|4X|
|DEV5|1H|5X|

>Developer’ların haftalık 45 saat çalıştığı varsayılarak, en kısa sürede işlerin bitmesini sağlayan bir algoritma ile haftalık developer bazında iş yapma programını ve işin minimum toplam kaç haftada biteceğini ekrana basacak bir ara yüz hazırlanmalı.  
  
## Conditions
  
- Programlama dili olarak PHP ve Framework olarak Symfony 4 tercih edilmeli.  
  
- 2 ayrı to-do iş listesi veren API'lerden (aşağıda mock server yanıtlarını bulabilirsiniz.) iş listesi çekilecek.  
  
- Burada iş listesini veren servisler Design Pattern ile geliştirilmeli ki daha sonra 3. bir iş listesi veren API'nin eklenmesi gerekirse (Provider 3) bu sadece API tanıtımı ile yapılabilsin.  
  
- Bu verileri API’lerden çekmek için command (console) yazılacak ve veri tabanına kaydedecek. Anasayfada veri tabanından okuduğu verilerle planlama sonucunu çıkartıp verileri gösterecek. İhtiyaç halinde ön yüzde Bootstrap ve Jquery vb. kullanılabilir.  
  
- Backend servisinde Facade, Factory, Proxy, Strategy veya Adapter vb. gibi patternleri ile geliştirme yapılması tercih edilir.  

## How to run
- php bin/console doctrine:database:create
- php bin/console doctrine:migrations:migrate 
- php bin/console doctrine:fixtures:load


> For run seed command you should change environment to dev mode!
After these steps, you should run console command to get data from APIs and save on database:
- php bin/console api:fetch [one/two | --empty 1]