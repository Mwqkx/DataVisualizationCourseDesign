<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="./plugins/echarts.min.js"></script>
    <title>Airplane Crashes</title>
</head>
<body>
    <div id="main" style="width: 100% ;height:900px;"></div>
    <?php
    echo <<<EOT
    <script type="text/javascript">
        var Chart = echarts.init(document.getElementById('main'));
        window.onload = function() {
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
                    // function randomColor() {
                    //     var ans = '#';
                    //     ans += '(' +  + ')'
                    //     return ans
                    // }
                    var option = {
                        title: {
                            text: 'Airplane Crashes - 1908 至 2009 年各时间段发生空难次数',
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
                    Chart.setOption(option);
                }
            }
            xhr.send()
        }
    </script>
    EOT;
    ?>
</body>
</html>