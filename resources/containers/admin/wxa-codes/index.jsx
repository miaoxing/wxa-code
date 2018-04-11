import React from 'react';
import ReactDOM from 'react-dom';
import {Button} from 'react-bootstrap';
import {Page, PageHeader, SearchForm, SearchItem, DataTable} from 'components';
import rp from 'require-promise';
import 'jquery-update-event';
import bootbox from 'comps/bootbox/bootbox';

const loader = Promise.all([
  import('query-url'),
  import('datatables-net-mx'),
  rp('daterangepicker'),
]);

class WxaCodesIndex extends React.Component {
  componentDidMount() {
    loader.then(() => {
      const $table = $('.js-wxa-code-table').dataTable({
        searchEl: '.js-wxa-code-form',
        searchEvent: 'update',
        ajax: {
          url: $.queryUrl2('admin/wxa-codes.json')
        },
        order: [],
        columns: [
          {
            title: '名称',
            data: 'name'
          },
          {
            title: '路径',
            data: 'path'
          },
          {
            title: '宽度',
            data: 'width',
          },
          {
            title: '自动配置线条颜色',
            data: 'autoColor',
            render: function (data) {
              return data ? '是' : '否';
            }
          },
          /*{
            title: '颜色',
            data: 'lineColor'
          },*/
          {
            title: '创建时间',
            data: 'createdAt'
          },
          {
            title: '操作',
            data: 'id',
            createdCell: (td, val) => {
              ReactDOM.render(<span>
                <a href={$.url('admin/wxa-codes/%s/edit', val)}>修改</a>
                {' '}
                <a className="js-delete-record text-danger" href="javascript:"
                  data-href={$.url('admin/wxa-codes/%s/destroy', val)}>
                  删除
                </a>
              </span>, td);
            }
          }
        ]
      });

      $table.deletable();
    });
  }

  render() {
    return (
      <Page>
        <PageHeader>
          <Button bsStyle="success" href={$.url('admin/wxa-codes/new')}>添加小程序码</Button>
        </PageHeader>

        <SearchForm className="js-wxa-code-form">

          <SearchItem label="名字" name="name"/>

          <SearchItem label="路径" name="path"/>
        </SearchForm>

        <DataTable className="js-wxa-code-table"/>
      </Page>
    )
  }
}

export default WxaCodesIndex;
