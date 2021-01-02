# DataVisualization
1908-2009年空难数据可视化
=====
`Preview`
-----
![](https://github.com/mwqkx/DataVisualizationCourseDesign/raw/master/img/localhost_datavisualizationcoursedesign_.png)
-----
`Source`
-----
    Airplane Crashes Since 1908 >   ■ [Link](https://www.kaggle.com/saurograndi/airplane-crashes-since-1908)
-----
`File`
-----
    ▲ index.php
        汇总各统计图表, 并增加词云图以及各表背景图等
    □ Airplane_Crashes_Day_Month_Year.html
        发生空难的年/月/日(y/m/d)散点图
            ■ src: year_month_day.json <[Year, Month.Day]>
    □ Airplane_Crahses_DeathRates.html
        有数据记录的空难的死亡率(遇难者人次Fatalities / 飞机搭乘人次Aboard)散点图
            ■ src: deathRates.json <[Aboard, DeathRate = Fatalities / Aboard]>
    □ Airplane_Crashes_FatalitiesAndAboardRates.html
        有数据记录的空难的遇难者数/乘客数以及死亡率的重叠柱状图/折线图
            ■ src: Fatalities.json <[Year, Aboard, Fatalities, DeathRates]>
    □ Airplane_Crashes_TimeCount.php
        有数据记录的空难的发生时间段旭日图统计
            ■ src: time.json   <[Hour, Minutes]>
`Folder`
-----
    · plugins:
        - echarts.min.js
    · xlsx:
        - Airplane_Crashes_and_Fatalities_Since_1908
            原始数据Excel文件
        - 借助Excel的中间处理过程文件
    · img:
        - 背景图片 / 词云图片 / 预览图等
`Enviroment`
-----
    Windows 10 Pro
    Apache 2.4.39
`Tools`
-----
    Vim 8.2
    IDLE (Python 3.7 64-bit)
    Visual Studio Code
    ECharts5 / PHP / JavsScript & Ajax / HTML / CSS
    Bootstrap 4
-----