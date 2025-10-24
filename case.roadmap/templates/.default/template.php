<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
?>

<!-- Roadmap :: Start-->
<section class="roadmap">
    <div class="container-fluid">
        <mark class="roadmap__mark"><?=htmlspecialchars($arResult['MARK_TEXT'])?></mark>
        <h2 class="roadmap__title"><?=htmlspecialchars($arResult['TITLE'])?></h2>
        
        <?php if(!empty($arResult['STEPS'])): ?>
        <table class="roadmap__table">
            <thead>
                <tr>
                    <th colspan="2">Этап</th>
                    <th>Сроки</th>
                    <th><?=htmlspecialchars($arResult['TABLE_HEADER_YEAR'])?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($arResult['STEPS'] as $step): ?>
                <tr>
                    <td><?=$step['NUMBER']?></td>
                    <td><?=htmlspecialchars($step['NAME'])?></td>
                    <td>
                        <ul class="roadmap__tetris">
                            <li>
                                <svg width="120" height="120" viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect x="96" y="77" width="34" height="34" rx="5" transform="rotate(180 96 77)" fill="#EF6969" />
                                    <rect x="96" y="115" width="34" height="34" rx="5" transform="rotate(180 96 115)" fill="#EF6969" />
                                    <rect x="58" y="115" width="34" height="34" rx="5" transform="rotate(180 58 115)" fill="#EF6969" />
                                    <rect x="58" y="77" width="34" height="34" rx="5" transform="rotate(180 58 77)" fill="#EF6969" />
                                </svg>
                            </li>
                            <li>
                                <svg width="120" height="120" viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect width="34" height="34" rx="5" transform="matrix(1 0 0 -1 43 115)" fill="#6D4DB7" />
                                    <rect width="34" height="34" rx="5" transform="matrix(1 0 0 -1 81 115)" fill="#6D4DB7" />
                                    <rect width="34" height="34" rx="5" transform="matrix(1 0 0 -1 5 115)" fill="#6D4DB7" />
                                </svg>
                            </li>
                            <li>
                                <svg width="120" height="120" viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect x="115" y="43" width="34" height="34" rx="5" transform="rotate(90 115 43)" fill="#F1ED27" />
                                    <rect x="115" y="81" width="34" height="34" rx="5" transform="rotate(90 115 81)" fill="#F1ED27" />
                                    <rect x="39" y="81" width="34" height="34" rx="5" transform="rotate(90 39 81)" fill="#F1ED27" />
                                    <rect x="115" y="5" width="34" height="34" rx="5" transform="rotate(90 115 5)" fill="#F1ED27" />
                                    <rect x="77" y="81" width="34" height="34" rx="5" transform="rotate(90 77 81)" fill="#F1ED27" />
                                </svg>
                            </li>
                            <li>
                                <svg width="120" height="120" viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect width="34" height="34" rx="5" transform="matrix(1 0 0 -1 43 115)" fill="#FF8F2D" />
                                    <rect width="34" height="34" rx="5" transform="matrix(1 0 0 -1 81 115)" fill="#FF8F2D" />
                                    <rect width="34" height="34" rx="5" transform="matrix(1 0 0 -1 43 77)" fill="#FF8F2D" />
                                    <rect width="34" height="34" rx="5" transform="matrix(1 0 0 -1 5 77)" fill="#FF8F2D" />
                                </svg>
                            </li>
                            <li>
                                <svg width="120" height="120" viewBox="0 0 120 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect width="34" height="34" rx="5" transform="matrix(1 0 0 -1 81 39)" fill="#49F049" />
                                    <rect width="34" height="34" rx="5" transform="matrix(1 0 0 -1 43 115)" fill="#49F049" />
                                    <rect width="34" height="34" rx="5" transform="matrix(1 0 0 -1 43 39)" fill="#49F049" />
                                    <rect width="34" height="34" rx="5" transform="matrix(1 0 0 -1 5 39)" fill="#49F049" />
                                    <rect width="34" height="34" rx="5" transform="matrix(1 0 0 -1 43 77)" fill="#49F049" />
                                </svg>
                            </li>
                        </ul>
                    </td>
                    <td><?=htmlspecialchars($step['DURATION'])?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php endif; ?>
    </div>
</section>
<!-- Roadmap :: End-->