/***
  ***********************************************
  ** ドラッグアンドドロップで画像をアップした時の動き **
  ***********************************************
****/
//ブラウザデフォルトのドラッグ＆ドロップ機能を無効化
// console.log("ok");

/*
 * フォームのDOMノード
 */
var editorFormElem = document.getElementById("editor_form");
/*
 * 編集エリアのDOMノード
 */
var editorAreaElem = document.getElementById("editor_area");
/*
 * 送信ボタンのDOMノード
 */
var submitButtonElem = document.getElementById("submit_button");
/**
 * Fileオブジェクトの格納用配列
 *
 * 送信する時、直接Fileオブジェクトを格納するために、保持しておく。
 *
 * @type {File[]}
 */
var fileList = [];
/**
 * FileオブジェクトをURLに変換する関数
 *
 * 第一引数に渡されたFileオブジェクトを元にして、
 * URL.createObjectURLが利用可能な場合はオブジェクトURLを、
 * 利用できない場合はFileReaderによるデータURIを生成し、
 * 第二引数のコールバック関数に渡す。
 *
 * @param {File} file
 * @param {function(string)} callback
 */
var fileToURL = (function(canUseCreateObjectURL) {
  if (canUseCreateObjectURL) {
    return function(file, callback) {
      var url = window.URL.createObjectURL(file);
      callback(url);
    };
  } else {
    return function(file, callback) {
      var reader = new FileReader;
      var url;

      reader.addEventListener("load", function(event) {
        url = event.target.result;
        callback(url);
      }, false);

      reader.addEventListener("error", function(event) {
        console.error("FileReader error: " + event.target.error.message);
      }, false);

      reader.readAsDataURL(file);
    };
  }
})(window.URL && window.URL.createObjectURL);



/**
 * dragenterイベントが発生したら、data-hover属性を追加してホバー表示する。
 *
 * @see http://www.html5rocks.com/ja/tutorials/dnd/basics/#toc-dragover-dragleave
 */
editorAreaElem.addEventListener("dragenter", function() {
  this.setAttribute("data-hover", "");
}, false);

/**
 * @see http://www.html5rocks.com/ja/tutorials/file/dndfiles/#toc-selecting-files-dnd
 */
editorAreaElem.addEventListener("dragover", function(event) {
  event.preventDefault();
  event.dataTransfer.dropEffect = "copy";
}, false);

/**
 * dragleaveイベントが発生したら、data-hover属性を削除してホバー表示を解除する。
 *
 * @see http://www.html5rocks.com/ja/tutorials/dnd/basics/#toc-dragover-dragleave
 */
editorAreaElem.addEventListener("dragleave", function() {
  this.removeAttribute("data-hover");
}, false);

/**
 * 画像ファイルがドロップされたら、エディタ内にimg要素で読み込む
 * @see http://www.html5rocks.com/ja/tutorials/dnd/basics/#toc-dnd-files
 */
editorAreaElem.addEventListener("drop", function(event) {
  var selection = window.getSelection();
  var files = event.dataTransfer.files;
  var i = 0;
  var file;

  event.preventDefault();
  event.stopPropagation();

  /*
   * ホバー表示用のdata-hover属性を削除
   */
  this.removeAttribute("data-hover");

  if (selection.anchorNode === null) {
    alert("テキストエリアにカーソルを合わせてください");
    return;
  }

  if (!files) {
    return;
  }

  /**
   * Fileオブジェクトを順に処理し、
   * img要素を追加
   */
  for (; file = files[i]; i++) {
    /*
     * 正規表現で、ファイルのMIMEタイプが画像か判定
     */
    if (!/^image\//.test(file.type)) {
      alert("画像ファイルをドロップしてください");
      continue;
    }

    /*
     * FileオブジェクトをURLに変換し、img要素を挿入
     */
    fileToURL(file, function(imgUrl) {
      var imgElem = document.createElement("img");
      var range = selection.getRangeAt(0);
      var imgIndex;

      /*
       * Fileオブジェクトの格納用配列に、
       * Fileオブジェクトを追加。
       * 追加後の配列の大きさから、Fileオブジェクトのインデックス番号を取得する。
       */
      imgIndex = fileList.push(file) - 1;

      imgElem.src = imgUrl;
      imgElem.width = 300;
      /*
       * インデックス番号をdata-img-index属性に設定しておく。
       */
      imgElem.setAttribute("data-img-index", imgIndex);

      range.insertNode(imgElem);
    });
  }
}, false);

/*
 * フォームが送信されたら、入力内容をAjaxで送信する。
 */
editorFormElem.addEventListener("submit", function(event) {
  var formData = new FormData(this);
  var xhr = new XMLHttpRequest();
  var divTmpElem = editorAreaElem.cloneNode(true);
  var defaultValue = submitButtonElem.value;
  var redirectUrl = this.getAttribute("data-redirect-url");
  var imgElemList, i, imgElem, imgIndex, file, imgComment;

  event.preventDefault();

  /*
   * 送信ボタンを無効化し、内容を変更
   */
  submitButtonElem.disabled = true;
  submitButtonElem.value = "送信中";

  /*
   * 挿入しておいたimg要素を取得し、順に処理していく。
   */
  imgElemList = Array.prototype.slice.call(divTmpElem.getElementsByTagName("img"));
  for (i = imgElemList.length; i--; ) {
    imgElem = imgElemList[i];
    /*
     * img要素に指定しておいたインデックス番号を取得
     */
    imgIndex = imgElem.getAttribute("data-img-index");
    /*
     * Fileオブジェクトを取得
     */
    file = fileList[imgIndex];

    /*
     * img要素を置換するためのコメントノードを生成
     *
     * Note: テキストノードだと、サーバで処理する時に
     *       紛らわしい入力文字列を誤って置換してしまう恐れがある。
     *       このため、コメントでimg要素を置き換える。
     */
    imgComment = document.createComment("img:" + imgIndex);
    /*
     * img要素をコメントノードで置換
     */
    imgElem.parentNode.replaceChild(imgComment, imgElem);

    /*
     * FormDataオブジェクトに画像のFileオブジェクトを追加
     */
    formData.append("img[" + imgIndex + "]", file);
  }

  /*
   * 入力内容のHTMLをFormDataオブジェクトに追加
   */
  formData.append("body", divTmpElem.innerHTML);

  xhr.addEventListener("error", function (event){
    alert("送信が失敗しました");

    /*
     * 無効化していたボタンを元に戻す。
     */
    submitButtonElem.disabled = false;
    submitButtonElem.value = defaultValue;

    console.error("送信エラー");
    console.log(event.target);
  },false);

  xhr.addEventListener("load", function (event){
    if (event.target.status == 200) {
      /*
       * 送信が成功したら、ページを移動
       */
      window.location.assign(redirectUrl);
    } else {
      /*
       * 無効化していたボタンを元に戻す。
       */
      submitButtonElem.disabled = false;
      submitButtonElem.value = defaultValue;

      console.log("入力に間違いがあります。");
    }
  }, false);

  xhr.open(this.getAttribute("method") , this.getAttribute("action"));
  xhr.send(formData);
}, false);