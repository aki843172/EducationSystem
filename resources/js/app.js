import './bootstrap';

// delivery-complete.jsの読み込み
import { setupDeliveryCompleteButton, setupVideoPlayer } from './delivery/delivery-complete.js';

// DOMContentLoadedイベントで初期化
document.addEventListener('DOMContentLoaded', () => {
    const completeButton = document.getElementById('complete_button');
    if (completeButton) {
        setupVideoPlayer();  // 動画の初期化を追加
        setupDeliveryCompleteButton();
    }
});