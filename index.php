<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" >
    <script src="./plugins/echarts.min.js"></script>

    <title>Airplane Crashes</title>
</head>
<!-- <body style="background-image: url('./img/1.jpg')"> -->
<body>
    <hr style="background-color: #e5d3a7; height: 2px; border: none; width: 97%" />
    <div class="alert alert-light" role="alert"><i class="text-secondary">DataVisualization</i><br /><u class="text-white" style="background-color: black"><a href="https://www.github.com/mwqkx/datavisualization" style="color: white">1908 - 2009年 空难数据可视化</a></u></div>
    <hr style="background-color: #d5c3d0; height: 2px; border: none; width: 97%" />
    <div id="main" style="width: 100% ;height:710px; background-image: url('./img/1.jpg');"></div>
    <br>
    <hr style="height: 1px; background-color: #c2befd" />
    <div id="scatter_1" style="width: 100% ;height:750px;"></div>
    <br>
    <hr style="background-color: #dc6f73; height: 2px; border: none; width: 97%" />
    <div id="minor" style="width: 100%;height:900px; background-image: url('./img/128345774.jpg');"></div>
    <hr style="background-color: #92c6dc; height: 2px; border: none; width: 97%" />
    <!-- <h4 style="color: #4cd59a">Airplane Crashes - 空难事故报告简述词云</h4> -->
    <p class="text-muted h4">&nbsp;&nbsp;> Airplane Crashes - 空难事故报告简述词云</p>
    <figure id="wordcloudimg" class="figure">
        <img src="./img/preview.jpg" alt="WordCloud of Airplane_Crashes - Tap to view original image" class="figure-img img-fluid rounded" />
        <figcaption class="figure-caption text-right">Preview of the WordCloud image. Click to View the Original Full Image.</figcaption>
    </figure>
    <div id="wordcloudimg"></div>
    <hr style="height: 1px; background-color: #cd2efc" />
    <div id="scatter_2" style="width: 100% ;height:750px;"></div>
    <hr style="height: 1px; background-color: #def9e7" />
    <?php
    echo <<<EOT
    <script type="text/javascript">
        var Chart_main = echarts.init(document.getElementById('main'));
        var Chart_minor = echarts.init(document.getElementById('minor'));
        var Chart_scatter_1 = echarts.init(document.getElementById('scatter_1'));
        document.getElementById('wordcloudimg').addEventListener('click', function viewPhoto(){window.open('./img/Airplane_Crashes.jpg');},false);
        var Chart_scatter_2 = echarts.init(document.getElementById('scatter_2'));
        window.onload = function() {
            // main
            var url = "./Fatalities.json";
            var xhr = new XMLHttpRequest();
            xhr.open("get", url, true);
            xhr.onload = function() {
                if(this.status == 200) {
                    var oriData = JSON.parse(this.responseText);
                    var xElement = new Array()
                    var Data = new Array(oriData[0].length)
                    // Process Year, Aboard, Fatalities and Rates array
                    var Year = new Array()
                    var Aboard = new Array()
                    var Fatalities = new Array()
                    var Rates = new Array()
                    for(var i = 1; i < oriData.length; ++i) {
                        Year.push(oriData[i][0]);
                        Aboard.push(oriData[i][1]);
                        Fatalities.push(oriData[i][2]);
                        Rates.push(oriData[i][3]);
                    }
                    Data[0] = Year;
                    Data[1] = Aboard;
                    Data[2] = Fatalities;
                    Data[3] = Rates;
                    var legend = new Array();
                    legend.push(oriData[0][1] + ' - 乘客数');
                    legend.push(oriData[0][2] + ' - 遇难人数');
                    legend.push(oriData[0][3] + ' - 遇难率');
                    var img = new Image();
                    img.src = "./img/dlpic.jpeg";
                    var option_main = {
                        // text: 'oblique',
                        title: {
                            text: ' > Airplane Crashes - 遇难数 / 乘客数 __ 遇难概率',
                            textStyle: {color: '#9ac32f'}
                        },
                        backgroundColor: {
                            type: "pattern",
                            repeat: "no-repeat",
                            image: img
                        },
                        dataZoom: [
                            // xAxis
                            {
                                bottom: -10,
                                type: 'slider',
                                xAxisIndex: 0
                            },
                            {
                                bottom: -10,
                                type: 'inside',
                                xAxisIndex: 0
                            },
                            // Left yAxis
                            {
                                right: -5,
                                type: 'slider',
                                yAxisIndex: 0
                            },
                            {
                                right: -5,
                                type: 'inside',
                                yAxisIndex: 0
                            },
                            // Right yAxis
                            {
                                right: -5,
                                type: 'slider',
                                yAxisIndex: 1,
                                start: 0,
                                end: 1
                            },
                            {
                                right: -5,
                                type: 'inside',
                                yAxisIndex: 1,
                                start: 0,
                                end: 1
                            }
                        ],
                        tooltip : {
                            trigger: 'axis',
                            axisPointer : {            
                                type : 'shadow'        
                            }
                        },
                        legend: {
                            data:legend
                        },
                        // backgroundColor: 'transparent',
                        // color: {
                        //     image: img
                        // },
                        grid: {
                            left: '7%',
                            right: '4.3%',
                            bottom: '7%',
                            containLabel: true
                        },
                        xAxis : [{
                            type : 'category',
                            data : Data[0],
                            name: 'Year - 年份'
                        }],
                        yAxis : [
                            {type : 'value', name: 'Quantity of Aboard / Victim (s) - 乘客数 / 遇难者数'},
                            // 右侧y轴用于显示比例
                            {type: 'value', name: 'Rate - 遇难概率'}
                        ],
                        series: [
                            {
                                // Aboard
                                name: legend[0],
                                type:'bar',
                                // stack: 'num',    // 堆叠
                                data: Data[1],
                                // Set item's parameter
                                itemStyle: {
                                    normal: {
                                        // Change color
                                        // color: "#57bd66"
                                        // color: 'rgba(143,236,100,0.77)'
                                        color: 'rgba(87,200,102,0.77)'
                                    }
                                }
                            },
                            {
                                // Fatalities
                                name: legend[1],
                                type:'bar',
                                // stack: 'num',
                                barGap: "-100%",    // 实现重叠柱状图
                                data: Data[2],
                                itemStyle: {
                                    normal: {
                                        // color: "#ffaa00eb"
                                        // color: 'rgba(255,230,0,0.7)'
                                        color: 'rgba(255,167,0,0.9)'
                                    }
                                }
                            },
                            {
                                // 折线 Rate
                                name: legend[2],
                                type: 'line',
                                yAxisIndex: 1,  // 采用第二个y轴
                                data: Data[3],
                                showSymbol: false,   // 去掉圆点
                                itemStyle: {
                                    normal: {
                                        // color: "#ff2400f2",
                                        color: 'rgb(229, 71, 79,0.2)',
                                        opacity: 0  // 设置为0, 则即使悬停在相应位置也不显示圆点
                                    }
                                },
                                areaStyle: {
                                    normal: {
                                        color: new echarts.graphic.LinearGradient(0,0,0,1,[ // 折线填充区域颜色渐变
                                            {offset: 0,color: 'rgba(80,141,255,0.39)'}, 
                                            {offset: .34,color: 'rgba(56,155,255,0.25)'},
                                            {offset: 1,color: 'rgba(38,197,254,0.00)'}
                                        ])
                                    }
                                }
                            }
                        ]
                    };
                    Chart_main.setOption(option_main);
                }
            }
            xhr.send();
            // scatter_1
            var url = "./deathrates.json";
            var xhr = new XMLHttpRequest();
            xhr.open("get", url, true);
            xhr.onload = function() {
                if(this.status == 200) {
                    var oriData = JSON.parse(this.responseText);
                    var bckimg = new Image();
                    bckimg.src = './img/w2cd71.jpg';
                    var option_scatter_1 = {
                        title: {
                            text: ' > Airplane Crashes - 1908-2009年空难遇难概率分布情况',
                            textStyle: {color: '#fc9bad'}
                        },
                        visualMap: [{
                            type: 'continuous',
                            min: 0,
                            max: 1,
                            color: ['#e91e63','#ffc107','#4caf50'],
                            itemHeight: 700,
                            padding: [0,0,0,300],
                            orient: 'horizontal',
                            range: [0, 1],
                            calculable: true,
                            text: ['High', 'Low'],
                            textStyle: {
                                color: '#fff',
                            },
                        }],
                        backgroundColor: {
                            type: "pattern",
                            repeat: "no-repeat",
                            image: bckimg,
                        },
                        dataZoom: [
                            // xAxis
                            {
                                bottom: -10,
                                type: 'inside',
                                xAxisIndex: 0
                            },
                            // Left yAxis
                            {
                                right: -5,
                                type: 'inside',
                                yAxisIndex: 0
                            },
                        ],
                        dataset: {
                            source: oriData
                        },
                        tooltip : {
                            trigger: 'axis',
                            axisPointer : {            
                                type : 'shadow'        
                            },  
                        },
                        legend: {
                            padding: [0,50,0,0],
                            textStyle: { 
                                // color: '#fefcfc', 
                                fontSize: 12,
                            },
                        },
                        grid: {
                            left: '2%',
                            bottom: '7%',
                            containLabel: true
                        },
                        xAxis : [{
                            type : 'category',
                            name: 'Aboard - 乘客数',
                            axisLabel: {
                                show: true,
                                // textStyle: { color: '#fefcfc', },
                            },
                            nameTextStyle: {
                                fontStyle: 'italic',
                                // color: '#fff'
                            },
                        }],
                        yAxis : [
                            {type : 'value', max: 1, name: '     DeathRate - 遇难概率',axisLabel: {
                                show: true,
                                // textStyle: { color: '##fefcfc', },
                            },nameTextStyle: {
                                fontStyle: 'oblique',
                                // color: '#fff'
                            },}
                        ],
                        series: [
                            {
                                // Month_Day 散点图 scatter
                                type:'scatter',
                                symbolSize: 3,  // 调整散点大小
                                itemStyle: {
                                    normal: {
                                        color: 'rgba(255,167,0,0.9)'
                                    }
                                }
                            },
                        ]
                    };
                    Chart_scatter_1.setOption(option_scatter_1);
                }
            }
            xhr.send();
            // minor
            var url = "./time.json";
            var xhr = new XMLHttpRequest();
            xhr.open("get", url, true);
            xhr.onload = function() {
                if(this.status == 200) {
                    var time = JSON.parse(this.responseText);
                    var seg = new Array(8);
                    for(var i=0;i<8;++i) {
                        seg[i] = 0;
                    }
                    var hour = new Array(8);    // hour[seg][cnt] = count
                    for(var i=0;i<8;++i) {
                        var tmp = new Array(3);
                        tmp[0] = tmp[1] = 0;
                        hour[i] = tmp;
                    }
                    var half = new Array(24);   // half[hour][cnt] = count
                    for(var i=0;i<24;++i) {
                        var tmp = new Array(2);
                        tmp[0] = tmp[1] = 0;
                        half[i] = tmp;
                    }
                    // count half
                    for(var i=0;i<time.length;++i) {
                        half[time[i][0]][time[i][1] >= 30 ? 1 : 0]++;
                    }
                    // count hours
                    for(var i=0;i<24;++i) {
                        hour[parseInt(i/3)][i - parseInt(i/3) * 3] = half[i][0] + half[i][1];
                    }
                    // count of per 3 hours
                    for(var i=0;i<8;++i) {
                        seg[i] = hour[i][0] + hour[i][1] + hour[i][2];
                    }
                    var option_minor = {
                        title: {
                            text: ' > Airplane Crashes - 1908 至 2009 年各时间段发生空难次数',
                            textStyle: {color: '#f30'}
                        },
                        tooltip: {},
                        legend: {
                            orient: "vertical",
                            x: "left",
                            y: "center",
                            padding: [0,50,0,0]
                        },
                        // xAxis: {},
                        // yAxis: {},
                        series: [{
                            type: 'sunburst',
                            data: [
    EOT;
                            function func_echo($name, $value) {
                                echo "{ name: '".$name."',value: ".$value.",";
                            }
                            function func_echoChild() {
                                echo "children: [";
                            }
                            for($i=0;$i<8;$i++) {
                                // echo "{ name: '".($i*3)+":00 - ".($i*3+2).":59',value: seg[$i],children:[";
                                func_echo(($i*3).":00 - ".($i*3+2).":59","seg[$i]");
                                func_echoChild();
                                for($j=0;$j<3;$j++) {
                                    func_echo(($i*3+$j).":00 - ".($i*3+$j).":59","hour[$i][$j]");
                                    func_echoChild();
                                    for($k=0;$k<2;$k++) {
                                        if($k==0) {
                                            func_echo(($i*3+$j).":00 - ".($i*3+$j).":29","half[$i * 3 + $j][$k]");
                                        }
                                        else func_echo(($i*3+$j).":30 - ".($i*3+$j).":59","half[$i * 3 + $j][$k]");
                                        echo "},\n";
                                    }
                                    echo "]},\n";    
                                }
                                echo "]},\n";
                            }
    echo <<<EOT
                            ],
                            color: {
                                type: 'linear',
                                x: 0,
                                y: 0,
                                x2: 0,
                                y2: 1,
                                colorStops: [{
                                    offset: 0, color: 'red' // 0% 处的颜色
                                }, {
                                    offset: 1, color: 'blue' // 100% 处的颜色
                                }],
                                global: false // 缺省为 false
                            },
                            // highlightPolicy: 'ancestor',
                            highlightPolicy: 'descendant',
                            radius: ['15%', '80%'],
                            label: {
                                rotate: 'radial',
                            },
                            itemStyle: {
                            //     color: '#9eb7d6',
                                borderWidth: 2,
                            },
                            highlight: {
                                itemStyle: {
                                    color: '#c97',
                                },
                            },
                            emphasis: {
                                itemStyle: {
                                    color: '#FF7853',
                                },
                            },
                            downplay: {
                                itemStyle: {
                                    color: '#e0ebeb',
                                },
                            },
                            center: ['40%','45%']   // 设置图表位置
                        }]
                    };
                    Chart_minor.setOption(option_minor);
                }
            }
            xhr.send();
            // scatter_2
            var url = "./year_month_day.json";
            var xhr = new XMLHttpRequest();
            xhr.open("get", url, true);
            xhr.onload = function() {
                if(this.status == 200) {
                    var oriData = JSON.parse(this.responseText);
                    var option_scatter_2 = {
                        // text: 'oblique',
                        title: {
                            text: ' > Airplane Crashes - 1908-2009年空难发生时间分布情况',
                            textStyle: {color: '#d2a121'}
                        },
                        visualMap: [
                            {
                                type: 'piecewise',
                                pieces: [
                                    {min:1.1, max:2.29},
                                    {min:3.1, max:5.31},
                                    {min:6.1, max: 8.31},
                                    {min:9.1, max:12.31}
                                ],
                                color: ['#e91e63','#ffc107','#4caf50'],
                                padding: [0,0,0,5],
                                // orient: 'vertical',
                                orient: 'horizontal'
                            },
                            {
                                type: 'continuous',
                                min: 1.1,
                                max: 12.31,
                                color: ['#e91e63','#ffc107','#4caf50'],
                                itemHeight: 700,
                                padding: [0,0,0,300],
                                orient: 'horizontal',
                                range: [1.1, 12.31],
                                calculable: true,
                                text: ['December', 'January']
                            }
                        ],
                        dataZoom: [
                            // xAxis
                            {
                                bottom: -10,
                                type: 'inside',
                                xAxisIndex: 0
                            },
                            // Left yAxis
                            {
                                right: -5,
                                type: 'inside',
                                yAxisIndex: 0
                            },
                        ],
                        dataset: {
                            source: oriData
                        },
                        tooltip : {
                            trigger: 'axis',
                            axisPointer : {            
                                type : 'shadow'        
                            },  
                        },
                        legend: {
                            padding: [0,50,0,0]
                        },
                        // backgroundColor: 'transparent',
                        // color: {
                        //     image: img
                        // },
                        grid: {
                            left: '2%',
                            // right: '3%',
                            bottom: '7%',
                            containLabel: true
                        },
                        xAxis : [{
                            type : 'category',
                            name: 'Year - 年份'
                        }],
                        yAxis : [
                            {type : 'value', max: 12.5, name: 'Date - 日期'}
                        ],
                        series: [
                            {
                                // Month_Day 散点图 scatter
                                type:'scatter',
                                symbolSize: 3,  // 调整散点大小
                                itemStyle: {
                                    normal: {
                                        color: 'rgba(255,167,0,0.9)'
                                    }
                                }
                            },
                        ]
                    };
                    Chart_scatter_2.setOption(option_scatter_2);
                }
            }
            xhr.send();
        }
    </script>
    EOT;
    ?>
</body>
</html>